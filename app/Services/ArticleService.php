<?php

namespace App\Services;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ArticleService {

    private $elasticsearch;

    public function __construct(Client $elasticsearch) {
        $this->elasticsearch = $elasticsearch;
    }

    public function saveArticle(Article $article) {

    }

    public function lockArticle(Article $article) {

        $article->is_locked = true;
        $article->locked_by_user = Auth::user()->id;
        $article->save();
    }
    public function unlockArticle(Article $article) {
        $article->is_locked = false;
        $article->locked_by_user = null;
        $article->save();
    }

    public function indexArticle(Article $article) {
        $this->elasticsearch->index([
            'index' => $article->getSearchIndex(),
            'type' => $article->getSearchType(),
            'id' => $article->getKey(),
            'body' => $article->toSearchArray(),
        ]);
    }

    public function updateDoc(Article $article) {
        $this->elasticsearch->update([
            'index' => 'articles',
            'id' => $article->id,
            'body' => [
                'doc' => $article->toSearchArray()
            ]
        ]);
    }

    public function deleteArticleDoc(Article $article) {
        $this->elasticsearch->delete([
            'index' => $article->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
        ]);
    }

    public function search(string $query='', $page = 1) {
        $items = $this->searchOnElastic($query, $page);
//        $this->buildCollection($items);
//        return [];
        return ArticleResource::collection($this->buildCollection($items));
    }

    public function getByIds($ids) {

        $arr = [];

        foreach ($ids as $id) {
            $arr[] = ['_index'=>'articles', '_id'=>$id];
        }

        $items = $this->elasticsearch->mget([
            'body' => [
                'docs' => $arr
            ]
        ]);
        return $items->asObject();
    }

    public function getById(Article $article) {
        $params = [
            'index' => $article->getSearchIndex(),
            'id' => $article->index_id
        ];
        $item = $this->elasticsearch->get($params);

        return $item->asObject();
    }

    private function searchOnElastic(string $query = '') {

        $items = $this->elasticsearch->search([
            'index' => 'articles',
            'type' => '_doc',
            'body' => [
                "size" => 100,
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => [
                                    'translations.locale' => app()->getLocale(),
                                ]
                            ],
                            [
                                'query_string' => [
                                    'query' => $query,
                                    'fields' => [
                                        'translations.title^5'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        return $items->asObject();
    }

    private function buildCollection($items){



        $ids = Arr::pluck($items->hits->hits,'_source.article_id');
//        dump($ids);
        return Article::findMany($ids)
            ->sortBy(function($article) use ($ids){
                return array_search($article->getKey(), $ids);
            });
    }

}

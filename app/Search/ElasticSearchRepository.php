<?php

namespace App\Search;

use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Support\Arr;

class ElasticSearchRepository {

    private $elasticsearch;

    public function __construct(Elasticsearch $elasticsearch) {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = '') {
        $items = $this->searchOnElasticSearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticSearch(string $query = '') {
        $model = new Article();

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5','body'],
                        'query' => $query,
                    ]
                ],
            ]
        ]);

    }

    private function buildCollection(array $items) {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return new ArticleCollection(
            Article::findMany($ids)
            ->sortBy(function ($article) use ($ids){
                return array_search($article->getId(), $ids);
            })
        );
    }
}

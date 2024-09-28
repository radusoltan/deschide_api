<?php

namespace App\Observers;

use App\Models\Article;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    private $elasticsearch;
    public function __construct(Client $client){
        $this->elasticsearch = $client;
    }
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
//        dd('here');
//        $elasticArticle = $this->elasticsearch->index([
//            'index' => $article->getSearchIndex(),
//            'type' => $article->getSearchType(),
//            'body' => $article->toSearchArray(),
//        ]);
//        $article->index_id = $elasticArticle->asObject()->_id;
//        $article->save();
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
//        $this->elasticsearch->update([
//            'index' => $article->getSearchIndex(),
//            'id' => $article->index_id,
//            'body' => [
//                'doc' => $article->toSearchArray()
//            ]
//        ]);
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
//        $this->elasticsearch->delete([
//            'index' => $article->getTable(),
//            'type' => '_doc',
//            'id' => $this->getKey(),
//        ]);
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
//        $this->elasticsearch->index([
//            'index' => 'articles',
//            'type' => '_doc',
//            'body' => $article->toSearchArray(),
//        ]);
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
//        $this->elasticsearch->delete([
//            'index' => $article->getTable(),
//            'type' => '_doc',
//            'id' => $this->getKey(),
//        ]);
    }
}

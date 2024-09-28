<?php

namespace App\Observers;

use App\Models\ArticleTranslation;
use Elastic\Elasticsearch\Client;


class ArticleTranslationObserver
{
    private $elasticsearch;
    public function __construct(Client $elasticsearch){
        $this->elasticsearch = $elasticsearch;
    }
    /**
     * Handle the ArticleTranslation "created" event.
     */
    public function created(ArticleTranslation $articleTranslation): void
    {
//        $elasticArticle = $this->elasticsearch->update([
//            'index' => $articleTranslation->article->getSearchIndex(),
//            'id' => $articleTranslation->article->index_id,
//            'body' => [
//                'doc' => $articleTranslation->article->toSearchArray()
//            ]
//        ]);
    }

    /**
     * Handle the ArticleTranslation "updated" event.
     */
    public function updated(ArticleTranslation $articleTranslation): void
    {
//        $article = ;
//        $articleTranslation->article->refresh();
//        $this->elasticsearch->update([
//            'index' => $articleTranslation->article->getSearchIndex(),
//            'id' => $articleTranslation->article->index_id,
//            'body' => [
//                'doc' => $articleTranslation->article->toSearchArray()
//            ]
//        ]);
    }

    /**
     * Handle the ArticleTranslation "deleted" event.
     */
    public function deleted(ArticleTranslation $articleTranslation): void
    {
        //
    }

    /**
     * Handle the ArticleTranslation "restored" event.
     */
    public function restored(ArticleTranslation $articleTranslation): void
    {
        //
    }

    /**
     * Handle the ArticleTranslation "force deleted" event.
     */
    public function forceDeleted(ArticleTranslation $articleTranslation): void
    {
        //
    }
}

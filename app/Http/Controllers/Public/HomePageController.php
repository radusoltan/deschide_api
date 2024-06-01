<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\FeaturedArticlesList;
use App\Services\ArticleService;
use App\Services\CloudFlareService;
use Illuminate\Support\Facades\Http;

class HomePageController extends Controller
{
    private $service;
    public function __construct(ArticleService $service){
        $this->service = $service;
    }

    public function getArticlesFromAPI() {



    }

    public function featuredListArticles() {

        return FeaturedArticlesList::find(1)
            ->articles()
            ->translatedIn(app()->getLocale())
            ->whereTranslation('status',"P")
            ->pluck('index_id');


    }

    public function getLastPublishedArticles() {
//        $articles = Article::whereTranslation('status', "P")
//            ->orderByTranslation('published_at', 'desc')
//            ->limit(9)
//            ->pluck("index_id");
//
//        return $this->service->getByIds($articles)->docs;
        return Article::whereTranslation('status', "P")
            ->orderByTranslation('published_at', 'desc')
            ->limit(9)
            ->pluck("index_id");
    }
}

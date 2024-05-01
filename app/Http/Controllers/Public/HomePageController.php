<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\FeaturedArticlesList;
use App\Services\ArticleService;

class HomePageController extends Controller
{
    private $service;
    public function __construct(ArticleService $service){
        $this->service = $service;
    }

    public function featuredListArticles() {

        $elasticArticles = $this->service->getByIds(FeaturedArticlesList::find(1)->articles()->pluck('index_id'));


        return $elasticArticles->docs;
    }
}

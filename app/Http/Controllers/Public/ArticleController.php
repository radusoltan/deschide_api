<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\ImageService;

class ArticleController extends Controller {

    private $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }

    public function show(Article $article) {

        return visits($article)->increment(20);
    }

    public function showArticle(Article $article) {

        visits($article)->increment();

        $this->articleService->updateDoc($article);
        $this->articleService->updateDocVisits($article);

        return response()->json($article->index_id);

    }
}

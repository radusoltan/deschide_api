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
        dump('here');
        return visits($article)->increment();
    }

    public function showArticle(Article $article) {
        visits($article)->increment();
        return response()->json([
            'article' => $this->articleService->getById($article),
            'visits' => visits($article)->count()
        ]);

    }
}

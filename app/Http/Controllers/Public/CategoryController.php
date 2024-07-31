<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\ArticleResource;
use App\Http\Resources\Public\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;

class CategoryController extends Controller {
    private $service;
    public function __construct(ArticleService $service){
        $this->service = $service;
    }

    public function getCategory($category){
        $category = Category::whereTranslation('slug', $category)->firstOrFail();

        return new CategoryResource($category);
    }

  public function getMostPopular(Category $category) {
      $ids = visits(Article::class)->top(100)->filter(function ($article) use ($category) {
          return $article->category_id === $category->id;
      })->pluck("index_id");


      return $this->service->getByIds($ids);
  }

}

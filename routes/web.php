<?php

use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\HomePageController;
use App\Http\Resources\Public\ArticleResource;
use App\Http\Resources\Public\CategoryCollection;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Laravel\Facades\Image as ImageManager;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomePageController::class,'getArticlesFromAPI']);


// Public Routes
Route::group(['middleware' => 'set_locale'],function (){

    Route::get('/article/{article}',[ArticleController::class,'show'])
        ->name('article.show');


    Route::get('categories', function (Request $request){
        return new CategoryCollection(Category::all());
    });
    Route::get('articles', function (Request $request){
//        dump(app()->getLocale()); die;
        $article = Article::find(1);
        visits($article)->increment();
        return new ArticleResource($article);
    });

    Route::get('lists', function (Request $request){
        return \App\Models\FeaturedArticlesList::find(1)->load('articles');
    });

    Route::group(['prefix'=>'homepage'], function (){
        Route::get('featuredListArticle', [HomePageController::class, 'featuredListArticles']);
        Route::get('lastPublishedArticles',[HomePageController::class, 'getLastPublishedArticles']);
    });
});

Route::get('/import',[\App\Http\Controllers\ImportController::class,'index']);

Route::get('radu', function (){


    $category = Category::find(1);
    $articles = Article::where('category_id',$category->id)
        ->whereTranslation('status', "P")
        ->get()
        ->load('vzt')
        ->sortByDesc(function ($article){
            return visits($article)->count();
        })
        ->take(10)
        ->pluck('index_id');
    ;

    return $articles;


});

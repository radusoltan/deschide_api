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

Route::get('/', function () {
    return view('welcome');
});



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
    });
});

Route::get('radu', function (){



    $categories = json_decode(file_get_contents(__DIR__.'/categories.json'));

    foreach($categories->items as $item) {
        $category = Category::where('old_number', $item->number)->first();
        if($item->language === app()->getLocale()) {

            if(!$category) {
                Category::create([
                    'title' => $item->title,
                    'old_number' => $item->number,
                    'slug' => \Illuminate\Support\Str::slug($item->title),
                ]);
            }
        } else if($item->language === 'en') {
            app()->setLocale('ru');
            $category->update([
                'title' => $item->title,
                'slug' => \Illuminate\Support\Str::slug($item->title),
            ]);
        }
    }

});

<?php

use App\Exports\ArticlesExport;
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
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('export-csv', [\App\Http\Controllers\ImportController::class, 'exportCSV']);

Route::get('radu-test', [\App\Http\Controllers\RaduTestController::class, 'index']);

Route::get('/import',[\App\Http\Controllers\ImportController::class,'import']);

Route::get('radu', function (\App\Services\FaceBookService $service){


// "id": "10210098744881597"
    $response = Http::get("https://graph.facebook.com/v20.0/10210098744881597/accounts?access_token=EAAFOZAm5DHSYBO6buevs28ETyZB3WZBsSwhD5zbUFd6KbLZC8qmx6iCDsWUatZB4A7yMFkCbAuzb2EYUSIncjVWKmupfVTnONicy1bqMIojBN0qRZBs5yQOXH0gxxsmW04cmSylpRAtgtVrwyg7jSCuYnnhMyMgEUCSJ0WeyPpQmObZA0oJlTh6CIAU4V1oTPAwDgGidsdI7izJTxMZD");
    $data = json_decode($response->body());
    app()->setLocale('ro');

    $article = Article::find(100);



    $service->postArticle($article);

//
//    $vzt = visits(Article::class)->top(10);
//
//    dump($vzt);

//    foreach ($vzt as $article){
////        $service->updateDoc($article);
////        dump($article->vzt()->count());
//        dump(visits($article)->count());
//    }
//    $category = Category::find(1);
//    $articles = Article::where('category_id',$category->id)
//        ->whereTranslation('status', "P")
//        ->get()
//        ->load('vzt')
//        ->sortByDesc(function ($article){
//            return visits($article)->count();
//        })
//        ->take(10)
//        ->pluck('index_id');
//    ;
//
//    return $articles;


});

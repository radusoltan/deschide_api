<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Public\CategoryController as CategoryPublicController;
use App\Http\Controllers\FeaturedArticlesListController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Public\HomePageController;
use App\Http\Controllers\RenditionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Resources\Public\CategoryCollection;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user()->load('permissions', 'roles.permissions');
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class, 'login']);

Route::group([
    'middleware' => ['set_locale'],
    'prefix'     => 'public',

], function(){

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/{category}/popular', [CategoryPublicController::class, 'getMostPopular']);
        Route::get('/{category}', [CategoryPublicController::class, 'getCategory']);
    });


    Route::group(['prefix'=>'homepage'], function (){
        Route::get('featuredListArticle', [HomePageController::class, 'featuredListArticles']);
        Route::get('categories', function (){
            return new CategoryCollection(
                Category::whereTranslation('in_menu', true)
                    ->translatedIn(app()->getLocale())
                    ->get()
            );
        });
        Route::get('articles/{article}', [\App\Http\Controllers\Public\ArticleController::class,'showArticle']);
        Route::get('lastPublishedArticles',[HomePageController::class, 'getLastPublishedArticles']);
    });

});

Route::group(['middleware' => ['auth:sanctum', 'set_locale']], function (){

    //Article routes
    Route::apiResource('articles', ArticleController::class);
    Route::get('/category/{category}/articles', [ArticleController::class,'getArticlesByCategory']);
    Route::post('/category/{category}/article', [ArticleController::class,'addCategoryArticle']);

    Route::get('/article/{article}/images',[ArticleController::class,'getArticleImages']);
    Route::post('/article/{article}/images',[ArticleController::class,'addArticleImages']);
    Route::post('/article/{article}/images-attach',[ArticleController::class,'articleImagesAttach']);
    Route::patch('/article/{article}/images',[ArticleController::class,'detachArticleImage']);
    Route::post('/article/{article}/image-set-main',[ArticleController::class,'setMainArticleImage']);
    Route::post('/article/{article}/publish-time',[ArticleController::class,'setPublishTime']);
    Route::delete('/article/{article}/delete-event',[ArticleController::class,'deleteEvent']);
    Route::get('/article/{article}/authors', [ArticleController::class,'getArticleAuthors']);
    Route::post('/article/{article}/add-author', [ArticleController::class,'addArticleAuthor']);
    Route::delete('/article/{article}/delete-author/{author}',[ArticleController::class,'deleteArticleAuthor']);
    Route::post('/article/{article}/select-author',[ArticleController::class,'selectArticleAuthor']);
    Route::get('/articles/{article}/lock', [ArticleController::class,'lockArticle']);
    Route::get('/articles/{article}/unlock', [ArticleController::class,'unlockArticle']);

    Route::post('/articles/search', [ArticleController::class,'searchArticle']);

    Route::apiResource('renditions', RenditionController::class);

    Route::apiResource('images', ImageController::class);

    Route::post('/image/{image}/crop',[ImageController::class,'crop']);
    Route::get('/image/{image}/thumbnails', [ImageController::class, 'getImageThumbnails']);

    //Author routes
    Route::apiResource('authors', AuthorController::class);
    Route::post('/authors/search',[AuthorController::class,'search']);

    //Category routes
    Route::apiResource('categories', CategoryController::class);

    Route::post('logout',[AuthController::class, 'logout']);

    //User routes
    Route::apiResource('users', UserController::class);

    //Role routes
    Route::apiResource('roles', RoleController::class);

    //Permission routes
    Route::apiResource('permissions', PermissionController::class);

    //Lists routes
    Route::apiResource('lists', FeaturedArticlesListController::class);
    Route::post('/lists/{list}/add-articles',[FeaturedArticlesListController::class,'addArticles']);
    Route::post('/lists/{list}/add-article',[FeaturedArticlesListController::class,'addArticle']);
    Route::post('/lists/{list}/delete-article',[FeaturedArticlesListController::class,'deleteArticle']);


});

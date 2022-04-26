<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImportController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'CORS'], function ($router) {
    
    Route::post('/login', [UserController::class, 'login'])->name('login.user');
    
    Route::get('/check-auth', [UserController::class,'checkAuth']);
    
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');

    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/category/{category}',[CategoryController::class,'show']);
    Route::post('/category',[CategoryController::class, 'store']);
    Route::patch('/category/{category}',[CategoryController::class, 'update']);
    Route::delete('/category/{category}',[CategoryController::class,'destroy']);
    Route::post('/category/{category}/translate',[CategoryController::class,'translate']);
    Route::patch('/category/{category}/publish',[CategoryController::class,'updateCategoryStatus']);
    Route::post('/category/{category}/add-article',[ArticleController::class,'addArticleByCategory']);
    // Route::resource('category',CategoryController::class);
    Route::get('/category/{category}/articles',[ArticleController::class,'getArticlesByCategory']);

    Route::get('/article/{article}',[ArticleController::class,'show']);
    Route::patch('/article/{article}',[ArticleController::class,'update']);

    Route::get('/article/{article}/images',[ArticleController::class,'getArticleImages']);
    Route::post('/article/{article}/upload-images',[ArticleController::class,'addArticleImages']);
    Route::post('/article/{article}/detach-images',[ArticleController::class,'detachArticleImages']);
    Route::get('/article/{article}/main-image',[ArticleController::class,'getArticleMainImage']);


    Route::get('/image/{image}/renditions',[ImageController::class,'getRenditions']);

    Route::get('/import/categories',[ImportController::class,'importCategories']);

    Route::post('/image/set-main',[ImageController::class,'setMainImage']);

    Route::get('/image-test',[ImageController::class,'getImageThumbs']);

});

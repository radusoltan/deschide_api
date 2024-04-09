<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user()->load('permissions', 'roles.permissions');
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'set_locale']], function (){

    //Article routes
    Route::apiResource('articles', ArticleController::class);
    Route::get('/category/{category}/articles', [ArticleController::class,'getArticlesByCategory']);
    Route::post('/category/{category}/article', [ArticleController::class,'addCategoryArticle']);

    Route::get('/article/{article}/images',[ArticleController::class,'getArticleImages']);
    Route::post('/article/{article}/images',[ArticleController::class,'addArticleImages']);

    //Author routes
    Route::apiResource('authors', AuthorController::class);

    //Category routes
    Route::apiResource('categories', CategoryController::class);

    Route::post('logout',[AuthController::class, 'logout']);

    //User routes
    Route::apiResource('users', UserController::class);

    //Role routes
    Route::apiResource('roles', RoleController::class);

    //Permission routes
    Route::apiResource('permissions', PermissionController::class);


});

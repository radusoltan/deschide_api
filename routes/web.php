<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function(){
    Route::get('getLoggedUser',[\App\Http\Controllers\UserController::class,'getLoggedUser']);
    Route::apiResource('categories',\App\Http\Controllers\CategoryController::class);
    Route::post('categories/{category}/publish',[\App\Http\Controllers\CategoryController::class,'publishCategory']);
    Route::get('categories/{category}/articles',[\App\Http\Controllers\CategoryController::class,'getArticles']);
    Route::post('categories/{category}/new-article',[\App\Http\Controllers\CategoryController::class,'addArticle']);
    Route::post('categories/{category}/translate',[\App\Http\Controllers\CategoryController::class,'translateCategory']);
    Route::apiResource('articles',\App\Http\Controllers\ArticleController::class);

});

require __DIR__.'/auth.php';

<?php

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    $image = Image::where('name', '=', '234.jpeg')->first();
    $path = public_path('storage\images') . '\\' . $image->name;
    list($width, $height) = getimagesize(asset($image->path));
    dump($image);
    return ['Laravel' => app()->version()];
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('getLoggedUser', [\App\Http\Controllers\UserController::class, 'getLoggedUser']);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::post('categories/{category}/publish', [\App\Http\Controllers\CategoryController::class, 'publishCategory']);
    Route::get('categories/{category}/articles', [\App\Http\Controllers\CategoryController::class, 'getArticles']);
    Route::post('categories/{category}/new-article', [\App\Http\Controllers\CategoryController::class, 'addArticle']);
    Route::post('categories/{category}/translate', [\App\Http\Controllers\CategoryController::class, 'translateCategory']);
    Route::apiResource('articles', \App\Http\Controllers\ArticleController::class);
    Route::get('articles/{article}/images', [\App\Http\Controllers\ArticleController::class, 'articleImages']);
    Route::post('articles/{article}/addImages', [\App\Http\Controllers\ArticleController::class, 'addArticleImages']);
    Route::post('article/{article}/detach', [\App\Http\Controllers\ArticleController::class, 'detachImage']);
    Route::apiResource('images', \App\Http\Controllers\ImageController::class);
    Route::get('images/getByArticle/{article}', [\App\Http\Controllers\ImageController::class, 'getByArticle']);
});

require __DIR__ . '/auth.php';

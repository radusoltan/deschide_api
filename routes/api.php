<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user()->load('permissions', 'roles.permissions');
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::post('logout',[AuthController::class, 'logout']);

    //User routes
    Route::apiResource('users', UserController::class);

    //Role routes
    Route::apiResource('roles', RoleController::class);

    //Permission routes
    Route::apiResource('permissions', PermissionController::class);


});

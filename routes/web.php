<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('radu', function (){

    $user = User::find(1);

    return new \App\Http\Resources\UserCollection(User::paginate(10));
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLoggedUser(){
        if (auth()->check()){
            $user = auth()->user();
            return response()->json([
                'user' => $user,
                'permissions' => $user->getAllPermissions()->pluck('name')
            ]);
        } else {
            return response()->json([
                'message' => 'message'
            ],422);
        }
        
    }
}

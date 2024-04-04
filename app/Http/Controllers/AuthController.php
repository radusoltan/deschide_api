<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => "required|string|email",
            'password' => "required|string"
        ]);

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('deschideApi')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }


    }

    public function logout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged Out!'
        ]);
    }
}

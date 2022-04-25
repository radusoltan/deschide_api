<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    protected $user;
    public function __construct(){
        $this->middleware("auth:api",["except" => ["login"]]);
        $this->user = new User;
    }

    public function login(Request $request){
        // dd($request);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        
        $credentials = $request->only(["email","password"]);
        $user = User::where('email',$credentials['email'])->first();
        if($user){
            if(!auth()->attempt($credentials)){
                $responseMessage = "Invalid username or password";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $responseMessage = "Login Successful";
            return $this->respondWithToken($accessToken,$responseMessage,auth()->user());
        } else {
            $responseMessage = "Sorry, this user does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function checkAuth(Request $request){
        $user = Auth::guard('api')->user();
        
        if ($user) {
            return response()->json(['state' => true], 200);
        }

        return response()->json(['state' => false], 401);
    }

    public function logout(){
        $user = Auth::guard("api")->user()->token();
        // dd($user);
        $user->revoke();
        $responseMessage = "successfully logged out";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }
}

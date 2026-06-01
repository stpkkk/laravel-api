<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }
    public function login(LoginUserRequest $request) 
    {
        if (!Auth::attempt($request->only("email","password"))) {
            return response()->json(["message" => "wrong email or password"], 401);   
        }


        // $user = Auth::user();
        $user = User::query()->where("email", $request->email)->first(); 
        // plainTextToken - строковое представление токена а не его хэш
        return response()->json([
            "user" => $user,
            "token" => $user->createToken("Token of user: {$user->name}")->plainTextToken,
        ]);   
    }
    public function logout(StoreUserRequest $request) 
    { 
         Auth::user()->currentAccessToken()->delete();
         return response()->json(["message"=> "user logout message, token removed"],0);
    }
}

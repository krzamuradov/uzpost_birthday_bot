<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = Auth::attempt(["login" => $request->login, "password" => $request->password]);
        if (!$user) {
            return response()->json([
                "message" => "Не верный логин или пароль"
            ], 401);
        }

        $token = Auth::user()->createToken("app", ["*"])->plainTextToken;
        return response()->json([
            "token" => $token
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}

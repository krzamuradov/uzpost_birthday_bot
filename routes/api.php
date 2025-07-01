<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/login", [LoginController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/logout", [LoginController::class, "logout"]);
    Route::apiResource("/members", MemberController::class);
});

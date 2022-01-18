<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/auth/login", [\App\Http\Controllers\AuthController::class, "login"]);

Route::group(["middleware" => "auth:sanctum"], function() {
    Route::post("/auth/check", [\App\Http\Controllers\AuthController::class, "check"]);
    Route::post("/auth/logout", [\App\Http\Controllers\AuthController::class, "logout"]);

    Route::get("/user/forms", [\App\Http\Controllers\UserController::class, "forms"]);
    Route::get("/user/forms/done", [\App\Http\Controllers\UserController::class, "done"]);

//    Route::get("/user/forms", [\App\Http\Controllers\UserController::class, "forms"]);
});

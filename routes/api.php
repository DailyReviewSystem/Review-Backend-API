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
Route::post("/auth/backend/login", [\App\Http\Controllers\AuthController::class, "backendLogin"]);

Route::group(["middleware" => "auth:sanctum"], function() {
    Route::post("/auth/check", [\App\Http\Controllers\AuthController::class, "check"]);
    Route::post("/auth/logout", [\App\Http\Controllers\AuthController::class, "logout"]);

    Route::get("/user/forms", [\App\Http\Controllers\UserController::class, "forms"]);
    Route::get("/real/{realForm}", [\App\Http\Controllers\RealFormController::class, "show"]);
    Route::post("/real/fill/{realForm}", [\App\Http\Controllers\RealFormController::class, "fill"]);

    Route::apiResource("user", \App\Http\Controllers\UserController::class);
    Route::apiResource("form", \App\Http\Controllers\FormController::class);
});

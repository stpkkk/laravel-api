<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['throttle:api'])->group(function () {
    Route::post('/v1/register', [AuthController::class, 'register']);
    Route::post('/v1/login', [AuthController::class, 'login']);
});


Route::middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    // Регистрируем Роут для категорий, при вызове эндпоинта вызовется экшены index из CategoryController
    // Route::get('/v1/categories',[App\Http\Controllers\Api\V1\CategoryController::class, 'index']);
    
    // ИЛИ Регистрируем все экшены из CategoryController разом 
    Route::apiResource('/v1/categories', CategoryController::class);
    Route::apiResource('/v1/posts', PostController::class);
    Route::get('/v1/logout', [AuthController::class, 'logout']);

});
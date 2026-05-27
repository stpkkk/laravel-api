<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Регистрируем Роут для категорий, при вызове эндпоинта вызовется экшены index из CategoryController
Route::get('/v1/categories',[App\Http\Controllers\Api\V1\CategoryController::class, 'index']);

// ИЛИ Регистрируем все экшены из CategoryController разом 
Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class);

Route::apiResource('v1/posts', App\Http\Controllers\Api\V1\PostController::class);
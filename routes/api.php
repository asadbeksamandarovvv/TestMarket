<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TariffController;

use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/verify', [AuthController::class, 'verify']);
Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::get('getMe', [AuthController::class, 'getMe'])->middleware('auth:api');
    Route::post('updateMe', [AuthController::class, 'updateMe'])->middleware('auth:api');
    Route::post('products/like', [ProductController::class, 'like'])->middleware('auth:api');
});

Route::get('sub_categories', [CategoryController::class, 'sub_categories']);
Route::apiResource('categories', CategoryController::class)->only(['index']);
Route::apiResource('products', ProductController::class)->only(['index']);
Route::apiResource('tariffs', TariffController::class)->only(['index']);
Route::apiResource('banners', BannerController::class)->only(['index']);
Route::apiResource('orders', OrderController::class)->only(['store', 'index'])->middleware('auth:api');

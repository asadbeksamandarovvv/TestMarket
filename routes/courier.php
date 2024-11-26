<?php

use App\Http\Controllers\Courier\AuthController;
use App\Http\Controllers\Courier\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/take/{id}', [OrderController::class, 'take']);
Route::get('orders/done/{id}', [OrderController::class, 'done']);


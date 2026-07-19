<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
});

Route::prefix('products')->group(function () {

    Route::middleware('jwt.auth')->group(function () {
        Route::post('/products-store', [ProductController::class, 'store']);
    });
});
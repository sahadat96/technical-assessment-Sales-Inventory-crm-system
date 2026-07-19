<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

// Auth
Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
});

// Product
Route::prefix('products')->group(function () {

    Route::middleware('jwt.auth')->group(function () {
        Route::post('/products-store', [ProductController::class, 'store']);
    });
});

// Sales
Route::prefix('sales')->group(function () {

    Route::middleware('jwt.auth')->group(function () {
        Route::post('/sales-store', [SaleController::class, 'store']);
    });
});
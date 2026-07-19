<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CustomerManagementController;

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

// Customer-Management
Route::prefix('customer-management')->group(function () {

    Route::middleware('jwt.auth')->group(function () {
        
        Route::get(
            '/customers/{customer}/purchase-history',
            [CustomerManagementController::class, 'purchaseHistory']
        );

        Route::get('/customers/lost', 
            [CustomerManagementController::class, 'lostCustomers']);

        Route::post(
            '/customer-campaigns/send',
            [CustomerManagementController::class,'send']
        );
    });
});
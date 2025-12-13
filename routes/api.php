<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::prefix('auth')->group(function () {
    Route::post('/register/customer', [AuthController::class, 'registerCustomer'])->name('auth.register.customer');
    Route::post('/register/vendor', [AuthController::class, 'registerVendor'])->name('auth.register.vendor');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // TODO: to be implemented later
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
    });

    Route::apiResource('addresses', AddressController::class)->middleware('role:customer');
});

// category routes

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


// Product Variant routes
Route::get('/product-variants', [ProductVariantController::class, 'index'])->name('product-variants.index');
Route::get('/product-variants/{id}', [ProductVariantController::class, 'show'])->name('product-variants.show');
Route::post('/product-variants', [ProductVariantController::class, 'store'])->name('product-variants.store');
Route::post('/product-variants/{id}', [ProductVariantController::class, 'update'])->name('product-variants.update');
Route::delete('/product-variants/{id}', [ProductVariantController::class, 'destroy'])->name('product-variants.destroy');

//Order routes to be implemented here
Route::post('/orders', [OrderController::class, 'store']);


//Order routes to be implemented later
// Route::prefix('orders')->group(function () {
//     Route::get('/', [OrderController::class, 'index'])->name('orders.index');
//     Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
//     Route::post('/', [OrderController::class, 'store'])->name('orders.store');
//     Route::post('/{id}', [OrderController::class, 'update'])->name('orders.update');
//     Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
// }); 


// Order Item routes can be added here
// Route::prefix('order-items')->group(function () {
//     // Define order item routes here
//     Route::get('/', [OrderItemController::class, 'index'])->name('order-items.index');
//     Route::post('/', [OrderItemController::class, 'store'])->name('order-items.store');
//     Route::get('/{id}', [OrderItemController::class, 'show'])->name('order-items.show');
//     Route::post('/{id}', [OrderItemController::class, 'update'])->name('order-items.update');
//     Route::delete('/{id}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');
// }); 



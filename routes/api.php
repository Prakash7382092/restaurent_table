<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
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

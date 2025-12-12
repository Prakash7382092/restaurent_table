<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendor\AuthController as VendorAuth;

Route::get('/', function () {
    return view('welcome');
});


// Other route definitions..

Route::prefix('vendor')->group(function () {
    Route::get('/login', [VendorAuth::class, 'login'])->name('vendor.login');
    Route::post('/login',[VendorAuth::class, 'check'])->name('vendor_login');
    Route::get('/dashboard', [VendorAuth::class, 'Index'])->name('vendor.dashboard');
    Route::get('/logout', [VendorAuth::class, 'logout'])->name('vendor.logout');
});



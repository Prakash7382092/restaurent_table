<?php

use App\Http\Controllers\vendor\AuthController;
use App\Http\Controllers\vendor\DashboardController;
use App\Http\Controllers\vendor\ProductController as VendorProductController;
use App\Http\Controllers\vendor\ProductVariantController as VendorProductVariant; 
use App\Http\Controllers\vendor\CategoryController as VendorCategoryVariant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->as('vendor.')->group(function () {
    // Dashboard (Vendor)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->as('admin.')->group(function () {
    // Dashboard (Admin)
    // Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});


/// Vendor Routes

Route::middleware(['auth', 'vendor'])
    ->prefix('vendor')  
    ->as('vendor.')
    ->group(function () {
        // Vendor Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Vendor Products (ONLY logged-in vendors)
        Route::get('/products', [VendorProductController::class, 'Index'])->name('products_index');             
        Route::post('/products', [VendorProductController::class, 'store'])->name('products_store');
        Route::get('/products/edit/{id}', [VendorProductController::class, 'Edit'])->name('edit_product');
        Route::post('/products/update', [VendorProductController::class, 'Update']) ->name('products_update');
        Route::get('/products/delete/{id}', [VendorProductController::class, 'Delete'])->name('products_delete');
        Route::get('/products/view/{id}', [VendorProductController::class, 'View']) ->name('view_product');  
        
        
        //  vendor Product Variant
        // Route::get('product_variant',[VendorProductVariant::class,'Index'])->name('product_variant');
        Route::post('product_variant', [VendorProductVariant::class,'Store'])
            ->name('product_variant_store');

        Route::get('product_variant/{id}', [VendorProductVariant::class,'Edit'])
            ->name('product_variant_edit');

        Route::post('product_variant/update', [VendorProductVariant::class,'Update'])
            ->name('product_variant_update');

        Route::get('product_variant/delete/{id}', [VendorProductVariant::class,'Delete'])
            ->name('product_variant_delete');


        
        // Categories 
         Route::get('/category', [VendorCategoryVariant::class, 'Index'])->name('categories');
         Route::post('category/store',[VendorCategoryVariant::class,'Store'])->name('category_store');
         Route::get('/categoryedit/{id}',[VendorCategoryVariant::class,'Edit'])->name('edit_category');
         Route::post('category/update',[VendorCategoryVariant::class,'Update'])->name('category_update');
         Route::get('/categorydelete/{id}',[VendorCategoryVariant::class,'Delete'])->name('category_delete');
        
});






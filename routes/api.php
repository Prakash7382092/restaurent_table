<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuItemController;
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

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    // Categories - Only logged-in customers
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

});



Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    //Categories
     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('/categories', [CategoryController::class, 'store']) ->name('categories.store');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']) ->name('categories.destroy');
    
    //Restaurents  

    Route::prefix('restaurants')->group(function () {       
        Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');       
        Route::get('/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');       
        Route::post('/', [RestaurantController::class, 'store'])->name('restaurants.store');      
        Route::post('/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');
        Route::delete('/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
    });

    // Reviews
    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index']);     
        Route::post('/', [ReviewController::class, 'store']);     
        Route::get('{id}', [ReviewController::class, 'show']);   
        Route::post('{id}', [ReviewController::class, 'update']); 
        Route::delete('{id}', [ReviewController::class, 'destroy']);
    });

    //Menus
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index');         
        Route::post('/', [MenuController::class, 'store'])->name('menus.store');        
        Route::get('/{id}', [MenuController::class, 'show'])->name('menus.show');       
        Route::post('/{id}', [MenuController::class, 'update'])->name('menus.update');  
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menus.destroy'); 
    }); 

    //Menu Items 

    Route::prefix('menu-items')->group(function () {
        Route::get('/', [MenuItemController::class, 'index'])->name('menu-items.index');
        Route::post('/', [MenuItemController::class, 'store'])->name('menu-items.store');
        Route::get('/{id}', [MenuItemController::class, 'show'])->name('menu-items.show');
        Route::post('/{id}', [MenuItemController::class, 'update'])->name('menu-items.update');
        Route::delete('/{id}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
    });     
});





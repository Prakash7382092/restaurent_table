<?php
//Vendor
use App\Http\Controllers\vendor\AuthController;
use App\Http\Controllers\vendor\DashboardController;
use App\Http\Controllers\vendor\CategoryController as VendorCategoryVariant;
use App\Http\Controllers\vendor\CoupunController as VendorCoupun;
use Illuminate\Support\Facades\Route;

//Admin
use App\Http\Controllers\Admin\VendorController as AdminVendor;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;

use App\Http\Controllers\Admin\AttributeController as AdminAttribute;
use App\Http\Controllers\Admin\AttributeValueController as AdminAttributeValue;
use App\Http\Controllers\Admin\CategoryAttributeController as AdminCategoryAttribute;
use App\Http\Controllers\Admin\ReviewController as AdminReview;

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
    Route::get('/', [DashboardController::class, 'AdminIndex'])->name('dashboard');
});



/// Vendor Routes
Route::middleware(['auth', 'vendor'])
    ->prefix('vendor')  
    ->as('vendor.')
    ->group(function () {
        // Vendor Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Vendor Products (ONLY logged-in vendors)
    
      
        
        // Categories 
         Route::get('/category', [VendorCategoryVariant::class, 'Index'])->name('categories');
         Route::post('category/store',[VendorCategoryVariant::class,'Store'])->name('category_store');
         Route::get('/categoryedit/{id}',[VendorCategoryVariant::class,'Edit'])->name('edit_category');
         Route::post('category/update',[VendorCategoryVariant::class,'Update'])->name('category_update');
         Route::get('/categorydelete/{id}',[VendorCategoryVariant::class,'Delete'])->name('category_delete');

      
         //Coupuns
         
        Route::get('/coupuns', [VendorCoupun::class, 'Index'])->name('coupuns'); 
         Route::post('/coupuns/store', [VendorCoupun::class, 'Store'])->name('coupons_store'); 
        
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')  
    ->as('admin.')
    ->group(function () {
      Route::get('/dashboard', [DashboardController::class, 'AdminIndex'])->name('dashboard');      
      Route::get('/vendors', [AdminVendor::class, 'Index'])->name('vendor');
      Route::post('/vendors/store',[AdminVendor::class,'Store'])->name('vendor_store');
      Route::get('/vendors/show/{id}',[AdminVendor::class,'Show'])->name('users_view');
      Route::get('/vendors/delete/{id}',[AdminVendor::class,'Delete'])->name('users_delete');
      Route::get('/vendors/approval/{id}',[AdminVendor::class,'Approve'])->name('users_approve');
      Route::get('/vendors/reject/{id}',[AdminVendor::class,'Reject'])->name('users_reject');
      Route::get('/vendors/edit/{id}',[AdminVendor::class,'Edit'])->name('users_edit');
      Route::post('/vendors/update',[AdminVendor::class,'Update'])->name('user_update');
     

          // Categories

         Route::get('/category', [AdminCategory::class, 'Index'])->name('categories');              
         Route::get('/category', [AdminCategory::class, 'Index'])->name('categories');
         Route::post('category/store',[AdminCategory::class,'Store'])->name('category_store');
         Route::get('/categoryedit/{id}',[AdminCategory::class,'Edit'])->name('edit_category');
         Route::post('category/update',[AdminCategory::class,'Update'])->name('category_update');
         Route::get('/categorydelete/{id}',[AdminCategory::class,'Delete'])->name('category_delete');

       
        

        
        // attributes
        Route::get('/attributes',[AdminAttribute::class,'Index'])->name('attributes');
        Route::post('/attributes/store',[AdminAttribute::class,'Store'])->name('attributes_store');
        Route::get('/attributes/edit/{id}', [AdminAttribute::class, 'Edit'])->name('edit_attributes');
        Route::post('/attributes/update', [AdminAttribute::class, 'Update'])->name('attributes_update');
        Route::get('/attributes/delete/{id}',[AdminAttribute::class,'Delete'])->name('delete_attributes');


        //Attribute Values
        Route::get('/attribute-values', [AdminAttributeValue::class, 'index'])->name('attribute_values');
        Route::get('/attribute-values/create', [AdminAttributeValue::class, 'create'])->name('attribute_values_create');
        Route::post('/attribute-values/store', [AdminAttributeValue::class, 'store'])->name('attribute_values_store');
        Route::get('/attribute-values/edit/{id}', [AdminAttributeValue::class, 'edit'])->name('attribute_values_edit');
        Route::post('/attribute-values/update', [AdminAttributeValue::class, 'update'])->name('attribute_values_update');
        Route::get('/attribute-values/delete/{id}', [AdminAttributeValue::class, 'delete']) ->name('attribute_values_delete');

        
         // Category Attributes CRUD
        Route::get('category-attributes', [AdminCategoryAttribute::class, 'index'])->name('category_attributes');
        Route::post('category-attributes/store', [AdminCategoryAttribute::class, 'store'])->name('category_attributes.store');
        Route::get('category-attributes/edit/{id}', [AdminCategoryAttribute::class, 'edit'])->name('category_attributes.edit');
        Route::post('category-attributes/update', [AdminCategoryAttribute::class, 'update'])->name('category_attributes.update');
        Route::get('category-attributes/delete/{id}', [AdminCategoryAttribute::class, 'delete'])->name('category_attributes.delete');
       
        //  Reviews
        Route::get('reviews', [AdminReview::class, 'index'])->name('reviews.index');
        Route::get('reviews/{id}', [AdminReview::class, 'show'])->name('reviews.show');
        Route::get('reviews/approve/{id}', [AdminReview::class, 'approve'])->name('reviews.approve');
        Route::get('reviews/reject/{id}', [AdminReview::class, 'reject'])->name('reviews.reject');
        Route::delete('reviews/{id}', [AdminReview::class, 'destroy'])->name('reviews.destroy');

        

        

        
});


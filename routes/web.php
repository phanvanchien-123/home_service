<?php

use App\Http\Controllers\Admin\AdminService_by_category;
use App\Http\Controllers\Admin\AdminServiceCategory;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Client\DetailsServiceController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Client\indexcontroller;
use App\Http\Controllers\Client\Servicecategories;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Sprovider\HomeController as SproviderHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Client
Route::get('/', [indexcontroller::class, 'index']);
Route::get('/service-categories',[Servicecategories::class,'index'])->name('home.service_categories');
Route::prefix('service')->group(function(){
    Route::get('/{category_slug}',[ServiceController::class,'index'])->name('home.serviecs_by_category');
    Route::get('/details_service/{service_slug}',[ServiceController::class,'show'])->name('show.details_service');
});


Auth::routes();
// Customer
Route::middleware('auth')->group(function(){
    Route::prefix('customer')->group(function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('customer.dashboard');
            
        
    });
});
// Admin
Route::middleware('auth','authadmin')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard',[AdminHomeController::class,'index'])->name('admin.dashboard');
        Route::prefix('/categories')->group(function(){
        Route::get('/',[AdminServiceCategory::class,'index'])->name('admin.service_categories');  
        Route::get('/add',[AdminServiceCategory::class,'add']) ->name('add.service_categories') ;
        Route::post('/',[AdminServiceCategory::class,'store']) ->name('store.service_categories') ;
        Route::get('/edit/{slug}', [AdminServiceCategory::class, 'edit'])->name('edit.service_categories');
        Route::put('/{slug}', [AdminServiceCategory::class, 'update'])->name('update.service_categories');
        Route::delete('/{slug}', [AdminServiceCategory::class, 'destroy'])->name('delete.service_categories');
        Route::get('{category_slug}/services',[AdminServiceCategory::class,'show'])->name('show.service_categories');
        });
        Route::resource('services', AdminService_by_category::class)->names([
            'index' => 'admin.services.index',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'show' => 'admin.services.show',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]);
    });
});
// Service Provider
Route::middleware('auth','authsprovider')->group(function(){
    Route::prefix('sprovider')->group(function(){
        Route::get('/dashboard',[SproviderHomeController::class,'index'])->name('sprovider.dashboard');
            
        
    });
});


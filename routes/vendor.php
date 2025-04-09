<?php

use App\Http\Controllers\System\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveVendor;


Route::middleware(IsActiveVendor::class)->prefix('/v/')->group(function () {
    // Route::get('/','VendorController@index')->name('vendor.index');
    Route::get('products', [VendorController::class, 'productView'])->name("vendor.products.view");
});

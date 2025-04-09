<?php

use App\Http\Controllers\System\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveVendor;


Route::get('vendor/upgtade', [VendorController::class, 'upgradeIndex'])->name('upgrade.vendor.index');
Route::get('vendor/upgtade/create', [VendorController::class, 'upgradeCreateRequest'])->name('upgrade.vendor.create');


Route::prefix('/v/')->group(function () {
    // Route::get('/','VendorController@index')->name('vendor.index');
    Route::get('products/list', [VendorController::class, 'productView'])->name("vendor.products.view");
});

<?php

use App\Http\Controllers\System\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveVendor;


Route::prefix('vendor/upgrade')->group(function () {
    Route::get('/', [VendorController::class, 'upgradeIndex'])->name('upgrade.vendor.index');
    Route::get('/create', [VendorController::class, 'upgradeCreateRequest'])->name('upgrade.vendor.create');
    Route::post('/store', [VendorController::class, 'upgradeStore'])->name('upgrade.vendor.store');
    Route::get('/{id}/edit', [VendorController::class, 'upgradeEdit'])->name('upgrade.vendor.edit');
    Route::post('/{id}/update', [VendorController::class, 'upgradeUpdate'])->name('upgrade.vendor.update');
    Route::post('/{id}/update-document', [VendorController::class, 'upgradeUpdateDocument'])->name('upgrade.vendor.updateDocument');
});


Route::prefix('/v/')->group(function () {
    // Route::get('/','VendorController@index')->name('vendor.index');
    Route::get('products/list', [VendorController::class, 'productView'])->name("vendor.products.view");
});




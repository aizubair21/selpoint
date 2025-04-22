<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveVendor;


use App\Livewire\Vendor\Products\Index as vendorProductsIndexPage;
use App\Livewire\Vendor\Products\Create as vendorProductsCreatePage;
use App\Livewire\Vendor\Products\Edit as vendorProductsEditPage;


Route::prefix('/v/')->group(function () {
    // Route::get('/','VendorController@index')->name('vendor.index');
    Route::get('products/view', vendorProductsIndexPage::class)->name("vendor.products.view")->middleware(AbleTo::class . ":product_view");
    Route::get('products/{id}/edit', vendorProductsEditPage::class)->name("vendor.products.edit")->middleware(AbleTo::class . ":product_edit");
    Route::get('products/create', vendorProductsCreatePage::class)->name("vendor.products.create")->middleware(AbleTo::class . ":product_add");
});

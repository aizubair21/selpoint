<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveVendor;


use App\Livewire\Vendor\Products\Index as vendorProductsIndexPage;
use App\Livewire\Vendor\Products\Create as vendorProductsCreatePage;
use App\Livewire\Vendor\Products\Edit as vendorProductsEditPage;

use App\Livewire\Vendor\Categories\Index as vendorCategoryIndexpage;
use App\Livewire\Vendor\Categories\Create as vendorCategoryCreatePage;


Route::prefix('/v/')->group(function () {
    // Route::get('/','VendorController@index')->name('vendor.index');
    Route::get('products/view', vendorProductsIndexPage::class)->name("vendor.products.view")->middleware(AbleTo::class . ":product_view");
    Route::get('products/{id}/edit', vendorProductsEditPage::class)->name("vendor.products.edit")->middleware(AbleTo::class . ":product_edit");
    Route::get('products/create', vendorProductsCreatePage::class)->name("vendor.products.create")->middleware(AbleTo::class . ":product_add");


    Route::prefix('category')->group(function () {
        Route::get('/', vendorCategoryIndexpage::class)->name('vendor.category.view')->middleware(AbleTo::class . ":category_view");
        Route::get('/create', vendorCategoryCreatePage::class)->name('vendor.category.create')->middleware(AbleTo::class . ":category_create");
    });
});

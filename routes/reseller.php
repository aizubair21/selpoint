<?php

use App\Http\Controllers\ResellerController;
use App\Http\Middleware\AbleTo;
use Illuminate\Support\Facades\Route;

use App\Livewire\Reseller\Products\Index as productIndexPage;
use App\Livewire\Reseller\Products\Create as productCreatePage;


Route::prefix('/r/')->group(function () {
    // routes for products
    Route::get('products/list', productIndexPage::class)->name("reseller.products.list")->middleware(AbleTo::class . ":product_view");
    Route::get('products/create', productCreatePage::class)->name('reseller.products.create')->middleware(AbleTo::class . ":product_add");

    // route for categories
})->middleware(AbleTo::class . ":access_reseller_dashboard");

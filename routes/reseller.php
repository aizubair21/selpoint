<?php

use App\Http\Controllers\ResellerController;
use App\Http\Middleware\AbleTo;
use Illuminate\Support\Facades\Route;

use App\Livewire\Reseller\Products\Index as productIndexPage;
use App\Livewire\Reseller\Products\Create as productCreatePage;

use App\Livewire\Reseller\Categories\Index as categoryIndexPage;


Route::prefix('/r/')->group(function () {
    // routes for products
    Route::get('products/list', productIndexPage::class)->name("reseller.products.list")->middleware(AbleTo::class . ":product_view");
    Route::get('products/create', productCreatePage::class)->name('reseller.products.create')->middleware(AbleTo::class . ":product_add");


    Route::get('/categories', categoryIndexPage::class)->name('reseller.categories.list')->middleware(AbleTo::class . ":category_view");
    // route for categories
})->middleware(AbleTo::class . ":access_reseller_dashboard");

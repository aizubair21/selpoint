<?php

use App\Http\Controllers\ResellerController;
use App\Http\Middleware\AbleTo;
use Illuminate\Support\Facades\Route;

use App\Livewire\Reseller\Products\Index as productIndexPage;
use App\Livewire\Reseller\Products\Create as productCreatePage;

use App\Livewire\Reseller\Categories\Index as categoryIndexPage;

use App\Livewire\Reseller\Resel\Products\Index as reselProductsIndexPage;
use App\Livewire\Reseller\Resel\Products\View as reselProductViewPage;
use App\Livewire\Reseller\Resel\Categories as reselCategoriesViewPage;
use App\Livewire\Reseller\Resel\Orders\Index as reselOrderIndexPage;


Route::prefix('/r/')->group(function () {
    // routes for products
    Route::get('products/list', productIndexPage::class)->name("reseller.products.list")->middleware(AbleTo::class . ":product_view");
    Route::get('products/create', productCreatePage::class)->name('reseller.products.create')->middleware(AbleTo::class . ":product_add");


    Route::get('/categories', categoryIndexPage::class)->name('reseller.categories.list')->middleware(AbleTo::class . ":category_view");

    // route for categories


    // resel product view 
    Route::get('/resel', reselProductsIndexPage::class)->name('reseller.resel-product.index');
    Route::get('/resel/product/{pd}', reselProductViewPage::class)->name('reseller.resel-product.veiw');
    Route::get('/resel/categories', reselCategoriesViewPage::class)->name('reseller.resel-products.catgory');
    Route::get('/order/resel', reselOrderIndexPage::class)->name('reseller.resel-order.index');
})->middleware(AbleTo::class . ":access_reseller_dashboard");

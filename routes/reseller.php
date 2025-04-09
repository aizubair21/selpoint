<?php

use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;


Route::prefix('/r/')->group(function () {
    // 
    Route::get('products/list', [ResellerController::class, 'productIndex'])->name("reseller.products.list");
});

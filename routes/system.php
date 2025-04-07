<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('system')->group(function () {

    // route for admin index to system dashboard
    Route::get('admins', function () {
        return view('auth.system.admins.index', ['admins' => User::role('admin')->get()]);
    })->name('system.admin')->middleware(AbleTo::class . ":admin_view");

    /**
     * vendors prefix for vendor actions route 
     */
    Route::prefix('vendors')->group(function () {
        /**
         * route for vendor index
         * as per permision
         */
        Route::get('/', [VendorController::class, 'viewToDashboard'])->name('system.vendor.index');


        /**
         * route for vendor edit
         * @return Vendor edit page
         */
        Route::get('/edit', [VendorController::class, 'edit'])->name('system.vendor.edit');
        Route::get('/settings', [VendorController::class, 'viewSettings'])->name('system.vendor.settings');
        Route::get('/documents', [VendorController::class, 'viewDocuments'])->name('system.vendor.documents');
        Route::get('/products', [VendorController::class, 'viewProducts'])->name('system.vendor.products');
        Route::get('/categories', [VendorController::class, 'viewCategories'])->name('system.vendor.categories');
        Route::get('/orders', [VendorController::class, 'viewOrders'])->name('system.vendor.orders');
    });
});

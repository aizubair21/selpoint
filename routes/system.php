<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


use App\Livewire\System\Vendors\Index as vendorIndexPage;
use App\Livewire\System\Vendors\Edit as vendorEdit;

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
        Route::get('/', vendorIndexPage::class)->name('system.vendor.index');
        // Route::view('/', vendorIndexPage::class)->name('system.vendor.index');


        /**
         * route for vendor edit
         * @return Vendor edit page
         */
        Route::middleware(AbleTo::class . ":vendors_edit")->group(function () {
            Route::get('/{id}/edit', vendorEdit::class)->name('system.vendor.edit');
            Route::get('/{id}/settings', [VendorController::class, 'viewSettings'])->name('system.vendor.settings');
            Route::get('/{id}/documents', [VendorController::class, 'viewDocuments'])->name('system.vendor.documents');
            Route::get('/{id}/products', [VendorController::class, 'viewProducts'])->name('system.vendor.products');
            Route::get('/{id}/categories', [VendorController::class, 'viewCategories'])->name('system.vendor.categories');
            Route::get('/{id}/orders', [VendorController::class, 'viewOrders'])->name('system.vendor.orders');
        });


        Route::post('/{id}/update', [VendorController::class, 'updateBySystem'])->name('system.vendor.update')->middleware(AbleTo::class . ":vendors_update");
    });
});

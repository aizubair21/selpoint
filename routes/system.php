<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use App\Http\Controllers\SystemUsersController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


use App\Livewire\System\Vendors\Index as vendorIndexPage;
use App\Livewire\System\Vendors\Edit as vendorEdit;

use App\Livewire\System\Vendors\Vendor\Settings as systemVendorSettingspage;
use App\Livewire\System\Vendors\Vendor\Documents as systemVendorDocumentsPage;
use App\Livewire\System\Vendors\Vendor\Products as systemVendorProductsPage;
use App\Livewire\System\Vendors\Vendor\Categories as systemVendorCategoriesPage;

Route::middleware(Authenticate::class)->prefix('system')->group(function () {

    // route for admin index to system dashboard
    Route::get('admins', function () {
        return view('auth.system.admins.index', ['admins' => User::role('admin')->get()]);
    })->name('system.admin')->middleware(AbleTo::class . ":admin_view");


    /**
     * route prefix dedicated for vendor management with permission
     */
    Route::prefix('vendors')->group(function () {
        /**
         * route for vendor index
         * as per permision
         */
        Route::get('/', vendorIndexPage::class)->name('system.vendor.index')->middleware(AbleTo::class . ":vendors_view");
        // Route::view('/', vendorIndexPage::class)->name('system.vendor.index');


        /**
         * route for vendor edit
         * @return Vendor edit page
         */
        Route::middleware(AbleTo::class . ":vendors_edit")->group(function () {
            Route::get('/{id}/edit', vendorEdit::class)->name('system.vendor.edit');
            Route::get('/{id}/settings', systemVendorSettingspage::class)->name('system.vendor.settings');
            Route::get('/{id}/documents', systemVendorDocumentsPage::class)->name('system.vendor.documents');
            Route::get('/{id}/products', systemVendorProductsPage::class)->name('system.vendor.products');
            Route::get('/{id}/categories', systemVendorCategoriesPage::class)->name('system.vendor.categories');
            Route::get('/{id}/orders', [VendorController::class, 'viewOrders'])->name('system.vendor.orders');
        });


        Route::post('/{id}/update', [VendorController::class, 'updateBySystem'])->name('system.vendor.update')->middleware(AbleTo::class . ":vendors_update");
    });


    /**
     * route prifix dedicated for user management with permission
     */

    Route::prefix('users')->group(function () {

        // permit to make users task
        Route::get('/', [SystemUsersController::class, 'admin_view'])->name('system.users.view')->middleware(AbleTo::class . ":users_view");
        Route::get('/edit/{email}', [SystemUsersController::class, 'admin_edit'])->name('system.users.edit')->middleware(AbleTo::class . ":users_edit");
        Route::post('/update/{id}', [SystemUsersController::class, 'admin_update'])->name("system.users.update")->middleware(AbleTo::class . ":users_update");
    });
});

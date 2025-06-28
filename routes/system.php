<?php

use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use App\Http\Controllers\SystemUsersController;
use App\Livewire\System\Comissions\Index as ComissionsIndex;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\System\Users\Edit as systemUserEditPage;
use App\Livewire\System\Users\Index as systemUserIndexPage;

use App\Livewire\System\Vendors\Index as vendorIndexPage;
use App\Livewire\System\Vendors\Edit as vendorEdit;
use App\Livewire\System\Vendors\Vendor\Settings as systemVendorSettingspage;
use App\Livewire\System\Vendors\Vendor\Documents as systemVendorDocumentsPage;
use App\Livewire\System\Vendors\Vendor\Products as systemVendorProductsPage;
use App\Livewire\System\Vendors\Vendor\Categories as systemVendorCategoriesPage;


use App\Livewire\System\Resellers\Index as systemResellerIndexPage;
use App\Livewire\System\Resellers\Edit as systemResellerEditPage;

use App\Livewire\System\Riders\Index as systemRiderIndexPage;
use App\Livewire\System\Riders\Edit as systemRiderEditPage;

use App\Livewire\System\Vip\Package\Index as systemVipIndexPage;
use App\Livewire\System\Vip\Users as systemVipUsersIndex;
use App\Livewire\System\Vip\Package\Create as systemVipCreatePage;
use App\Livewire\System\Vip\Package\Edit as systemVipEditPage;
use App\Livewire\System\Vip\Edit;

use App\Livewire\System\Store\Index;

use App\Livewire\Vendor\Products\Index as systemGlobalProductsIndexPage;

use App\Livewire\System\Navigations\Index as NavigationsIndex;
use App\Livewire\System\Slider\Slider;
use App\Livewire\System\Slider\Slides;

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
     * Rotue prefix dedicated for reseller management 
     */
    Route::prefix('reseller')->group(function () {
        Route::get('/', systemResellerIndexPage::class)->name('system.reseller.index');
        Route::get('/{id}/edit', systemResellerEditPage::class)->name('system.reseller.edit');
    });


    /**
     * route prifix dedicated for user management with permission
     */

    Route::prefix('users')->group(function () {

        // permit to make users task    
        Route::get('/', systemUserIndexPage::class)->name('system.users.view')->middleware(AbleTo::class . ":users_view");
        Route::get('/edit/{id}', systemUserEditPage::class)->name('system.users.edit')->middleware(AbleTo::class . ":users_edit");
        Route::post('/update/{id}', [SystemUsersController::class, 'admin_update'])->name("system.users.update")->middleware(AbleTo::class . ":users_update");
    });


    /**
     * routes dedicated for rider management
     * 
     */
    Route::prefix('rider')->group(function () {
        Route::get('/', systemRiderIndexPage::class)->name("system.rider.index")->middleware(AbleTo::class . ":riders_view");
        Route::get('/{id}/edit', systemRiderEditPage::class)->name('system.rider.edit')->middleware(AbleTo::class . ":riders_edit");
    });


    /** 
     * VIP 
     */
    Route::get('/packages', systemVipIndexPage::class)->name('system.vip.index');
    Route::get('/package/create', systemVipCreatePage::class)->name('system.vip.crate');
    Route::get('/package/{packages}', systemVipEditPage::class)->name('system.package.edit');

    Route::get('/vip/{vip}', Edit::class)->name('system.vip.edit');
    Route::get('/vips', systemVipUsersIndex::class)->name('system.vip.users');



    /**
     * system coin store management
     */
    Route::get('/coins', Index::class)->name('system.store.index');


    /**
     * routes for products management for system
     */
    Route::prefix('products')->group(function () {
        Route::get('/', systemGlobalProductsIndexPage::class)->name('system.products');
    });


    /**
     * navigations
     */
    Route::get('/navigations/list', NavigationsIndex::class)->name('navigations.index');


    /**
     * slider
     */
    Route::get('/sliders', Slider::class)->name('system.slider.index');
    Route::get('/sliders/slides', Slides::class)->name('system.slider.slides');


    Route::get('/comissions', ComissionsIndex::class)->name('system.comissions.index');


    /**
     * API Docs
     */
    Route::prefix('/api')->group(function () {

        Route::get('/', function () {
            return view('Api.start');
        })->name('api.index');

        Route::get('/auth', function () {
            return view('Api.auth');
        })->name('api.auth');
    });
});

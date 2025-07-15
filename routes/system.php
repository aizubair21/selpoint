<?php

use App\Http\Controllers\ProductComissionController;
use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use App\Http\Controllers\SystemUsersController;
use App\Livewire\Reseller\Orders\Index as OrdersIndex;
use App\Livewire\System\Comissions\Index as ComissionsIndex;
use App\Livewire\System\Comissions\Takes;
use App\Livewire\System\Comissions\TakesDetails;
use App\Livewire\System\Comissions\TakesDistributes;
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

use App\Livewire\System\Products\Index as systemGlobalProductsIndexPage;

use App\Livewire\System\Navigations\Index as NavigationsIndex;
use App\Livewire\System\Orders\Details;
use App\Livewire\System\Orders\Index as SystemOrdersIndex;
use App\Livewire\System\Products\Filter;
use App\Livewire\System\Slider\Slider;
use App\Livewire\System\Slider\Slides;
use App\Models\DistributeComissions;
use App\Models\TakeComissions;

Route::middleware(Authenticate::class)->name('system.')->prefix('system')->group(function () {

    // route for admin index to system dashboard
    Route::get('admins', function () {
        return view('auth.system.admins.index', ['admins' => User::role('admin')->get()]);
    })->name('admin')->middleware(AbleTo::class . ":admin_view");


    /**
     * route prefix dedicated for vendor management with permission
     */
    Route::prefix('vendors')->group(function () {
        /**
         * route for vendor index
         * as per permision
         */
        Route::get('/', vendorIndexPage::class)->name('vendor.index')->middleware(AbleTo::class . ":vendors_view");
        // Route::view('/', vendorIndexPage::class)->name('vendor.index');


        /**
         * route for vendor edit
         * @return Vendor edit page
         */
        Route::middleware(AbleTo::class . ":vendors_edit")->group(function () {
            Route::get('/{id}/edit', vendorEdit::class)->name('vendor.edit');
            Route::get('/{id}/settings', systemVendorSettingspage::class)->name('vendor.settings');
            Route::get('/{id}/documents', systemVendorDocumentsPage::class)->name('vendor.documents');
            Route::get('/{id}/products', systemVendorProductsPage::class)->name('vendor.products');
            Route::get('/{id}/categories', systemVendorCategoriesPage::class)->name('vendor.categories');
            Route::get('/{id}/orders', [VendorController::class, 'viewOrders'])->name('vendor.orders');
        });


        Route::post('/{id}/update', [VendorController::class, 'updateBySystem'])->name('vendor.update')->middleware(AbleTo::class . ":vendors_update");
    });


    /**
     * Rotue prefix dedicated for reseller management 
     */
    Route::prefix('reseller')->group(function () {
        Route::get('/', systemResellerIndexPage::class)->name('reseller.index');
        Route::get('/{id}/edit', systemResellerEditPage::class)->name('reseller.edit');
    });


    /**
     * route prifix dedicated for user management with permission
     */

    Route::prefix('users')->group(function () {

        // permit to make users task    
        Route::get('/', systemUserIndexPage::class)->name('users.view')->middleware(AbleTo::class . ":users_view");
        Route::get('/edit/{id}', systemUserEditPage::class)->name('users.edit')->middleware(AbleTo::class . ":users_edit");
        Route::post('/update/{id}', [SystemUsersController::class, 'admin_update'])->name("users.update")->middleware(AbleTo::class . ":users_update");
    });


    /**
     * routes dedicated for rider management
     * 
     */
    Route::prefix('rider')->group(function () {
        Route::get('/', systemRiderIndexPage::class)->name("rider.index")->middleware(AbleTo::class . ":riders_view");
        Route::get('/{id}/edit', systemRiderEditPage::class)->name('rider.edit')->middleware(AbleTo::class . ":riders_edit");
    });


    /** 
     * VIP 
     */
    Route::get('/packages', systemVipIndexPage::class)->name('vip.index');
    Route::get('/package/create', systemVipCreatePage::class)->name('vip.crate');
    Route::get('/package/{packages}', systemVipEditPage::class)->name('package.edit');

    Route::get('/vip/{vip}', Edit::class)->name('vip.edit');
    Route::get('/vips', systemVipUsersIndex::class)->name('vip.users');



    /**
     * system coin store management
     */
    Route::get('/coins', Index::class)->name('store.index');


    /**
     * routes for products management for system
     */
    Route::prefix('products')->group(function () {
        Route::get('/index', systemGlobalProductsIndexPage::class)->name('products');
        Route::get('/filter', Filter::class)->name('products.filter');
    });


    /**
     * navigations
     */
    Route::get('/navigations/list', NavigationsIndex::class)->name('navigations.index');


    /**
     * slider
     */
    Route::get('/sliders', Slider::class)->name('slider.index');
    Route::get('/sliders/slides', Slides::class)->name('slider.slides');


    Route::get('/comissions', ComissionsIndex::class)->name('comissions.index');
    Route::get('/comissions/take', Takes::class)->name('comissions.takes');
    Route::get('/comissions/{id}', TakesDetails::class)->name('comissions.details');
    Route::get('/comissions/takes/{id}', TakesDistributes::class)->name('comissions.distributes');

    Route::post('/comissions/delete', [ProductComissionController::class, 'deleteComissions'])->name('comissions.destroy');
    Route::delete('/comissions/reseller-profit/delete/{id}', [ProductComissionController::class, 'deleteResellerProfit'])->name('reseller-profit.destroy');

    Route::post('/comissions/order/{id}', function ($id) {
        $cc = new ProductComissionController();
        $cc->dispatchProductComissionsListeners($id);

        if (empty($cc)) {
            return redirect()->back()->with('success', 'Comission Confirmed');
        } else {
            return redirect()->back()->with('error', 'Have an error, see the log file');
        }
    })->name('comissions.confirm');

    Route::post('/comissions/confirm/take/{id}', function ($id) {
        // 
        try {

            $cc = new ProductComissionController();
            $cc->confirmSingleTakeComissions($id);
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.take.confirm');


    Route::get('/comissions/refund/take/{id}', function ($id) {
        // 
        try {

            $cc = new ProductComissionController();
            $cc->roleBackDistributedComissions($id);
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.take.refund');


    Route::get('/comissions/confirm/distribute/{id}', function ($id) {

        try {
            $dis = DistributeComissions::findOrFail($id);
            $dis->confirmed = true;
            $dis->save();
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.distribute.confirm');

    Route::get('/comissions/refund/distribute/{id}', function ($id) {
        try {
            $dis = DistributeComissions::findOrFail($id);
            $dis->confirmed = false;
            $dis->save();
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.distribute.refund');



    /**
     * system order management
     */
    Route::prefix('orders')->name('orders.')->group(
        function () {
            Route::get('/', SystemOrdersIndex::class)->name('index');
            Route::get('/{id}', Details::class)->name('details');
        }
    );



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

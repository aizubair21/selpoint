<?php

use App\Http\Controllers\ProductComissionController;
use App\Http\Controllers\System\VendorController;
use App\Http\Middleware\AbleTo;
use App\Models\User;
use App\View\Components\dashboard\overview\system\VendorCount;
use App\Http\Controllers\SystemUsersController;
use App\Livewire\FooterBuilder;
use App\Livewire\Reseller\Categories\Index as CategoriesIndex;
use App\Livewire\Reseller\Orders\Index as OrdersIndex;
use App\Livewire\System\Categories\Edit as CategoriesEdit;
use App\Livewire\System\Categories\Index as SystemCategoriesIndex;
use App\Livewire\System\Comissions\Index as ComissionsIndex;
use App\Livewire\System\Comissions\Takes;
use App\Livewire\System\Comissions\TakesDetails;
use App\Livewire\System\Comissions\TakesDistributes;
use App\Livewire\System\Deposit\Index as DepositIndex;
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
use App\Livewire\System\Settings\Index as SettingsIndex;
use App\Livewire\System\Settings\Pages\Index as PagesIndex;
use App\Livewire\System\Settings\Pages\Edit as PagesEdit;
use App\Livewire\System\Settings\Pages\Create as PagesCreate;
use App\Livewire\System\Slider\Slider;
use App\Livewire\System\Slider\Slides;
use App\Livewire\System\Withdraw\Index as WithdrawIndex;
use App\Livewire\System\Withdraw\View as WithdrawDetails;

use App\Models\DistributeComissions;
use App\Models\TakeComissions;

use function Laravel\Prompts\form;

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
        Route::get('/', systemResellerIndexPage::class)->name('reseller.index')->middleware(AbleTo::class . ":resellers_view");
        Route::get('/{id}/edit', systemResellerEditPage::class)->name('reseller.edit')->middleware(AbleTo::class . ":resellers_edit");
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
    Route::get('/packages', systemVipIndexPage::class)->name('vip.index')->middleware(AbleTo::class . ":vip_view");
    Route::get('/package/create', systemVipCreatePage::class)->name('vip.crate')->middleware(AbleTo::class . ":vip_add");
    Route::get('/package/{packages}', systemVipEditPage::class)->name('package.edit')->middleware(AbleTo::class . ":vip_update");

    Route::get('/vip/{vip}', Edit::class)->name('vip.edit')->middleware(AbleTo::class . ":vip_user_edit");
    Route::get('/vips', systemVipUsersIndex::class)->name('vip.users')->middleware(AbleTo::class . ":vip_user_view");



    /**
     * system coin store management
     */
    Route::get('/coins', Index::class)->name('store.index')->middleware(AbleTo::class . ":store_view");


    /**
     * routes for products management for system
     */
    Route::prefix('products')->group(function () {
        Route::get('/index', systemGlobalProductsIndexPage::class)->name('products.index');
    })->middleware(AbleTo::class . 'product_view');


    /**
     * Routes for manage syste categories
     */
    Route::get('/categories',  SystemCategoriesIndex::class)->name('categories.index')->middleware(AbleTo::class . ":category_view");
    Route::get('/categories/{cid}', CategoriesEdit::class)->name('categories.edit')->middleware(AbleTo::class . ":category_edit");

    /**
     * navigations
     */
    Route::get('/navigations/list', NavigationsIndex::class)->name('navigations.index');


    /**
     * slider
     */
    Route::get('/sliders', Slider::class)->name('slider.index')->middleware(AbleTo::class . ":slider_view");
    Route::get('/sliders/slides', Slides::class)->name('slider.slides')->middleware(AbleTo::class . ":slider_edit");


    /**deposit */
    Route::get('/deposit', DepositIndex::class)->name('deposit.index')->middleware(AbleTo::class . ":deposit_view");


    Route::get('/comissions', ComissionsIndex::class)->name('comissions.index')->middleware(AbleTo::class . ":comission_view");
    Route::get('/comissions/take', Takes::class)->name('comissions.takes')->middleware(AbleTo::class . ":comission_view");
    Route::get('/comissions/{id}', TakesDetails::class)->name('comissions.details')->middleware(AbleTo::class . ":comission_view");
    Route::get('/comissions/takes/{id}', TakesDistributes::class)->name('comissions.distributes')->middleware(AbleTo::class . ":comission_confirm");

    Route::post('/comissions/delete', [ProductComissionController::class, 'deleteComissions'])->name('comissions.destroy')->middleware(AbleTo::class . ":comission_delete");
    Route::delete('/comissions/reseller-profit/delete/{id}', [ProductComissionController::class, 'deleteResellerProfit'])->name('reseller-profit.destroy')->middleware(AbleTo::class . ":comission_delete");

    Route::post('/comissions/order/{id}', function ($id) {
        $cc = new ProductComissionController();
        $cc->dispatchProductComissionsListeners($id);

        if (empty($cc)) {
            return redirect()->back()->with('success', 'Comission Confirmed');
        } else {
            return redirect()->back()->with('error', 'Have an error, see the log file');
        }
    })->name('comissions.confirm')->middleware(AbleTo::class . ":comission_confim");

    Route::post('/comissions/confirm/take/{id}', function ($id) {
        // 
        try {

            $cc = new ProductComissionController();
            $cc->confirmSingleTakeComissions($id);
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.take.confirm')->middleware(AbleTo::class . ":comission_confim");


    Route::get('/comissions/refund/take/{id}', function ($id) {
        // 
        try {

            $cc = new ProductComissionController();
            $cc->roleBackDistributedComissions($id);
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.take.refund')->middleware(AbleTo::class . ":comission_update");


    Route::get('/comissions/confirm/distribute/{id}', function ($id) {

        try {
            $dis = DistributeComissions::findOrFail($id);
            $dis->confirmed = true;
            $dis->save();
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.distribute.confirm')->middleware(AbleTo::class . ":comission_confim");

    Route::get('/comissions/refund/distribute/{id}', function ($id) {
        try {
            $dis = DistributeComissions::findOrFail($id);
            $dis->confirmed = false;
            $dis->save();
            return redirect()->back()->with('success', 'Comissions Confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    })->name('comissions.distribute.refund')->middleware(AbleTo::class . ":comission_update");



    /**
     * system order management
     */
    Route::prefix('orders')->name('orders.')->group(
        function () {
            Route::get('/', SystemOrdersIndex::class)->name('index');
            Route::get('/{id}', Details::class)->name('details');
        }
    )->middleware(AbleTo::class . ':order_view');


    /**
     * system withdraw
     */
    Route::prefix('withdraw')->group(
        function () {
            Route::get('/', WithdrawIndex::class)->name('withdraw.index');
            Route::get('/take{id}', WithdrawDetails::class)->name('withdraw.view');
        }
    )->middleware(AbleTo::class . ":withdraw_view");


    // settings 
    Route::get('/settings', SettingsIndex::class)->name('settings.index');
    Route::get('/pages', PagesIndex::class)->name('pages.index');
    Route::get('/pages/add-new', PagesCreate::class)->name('pages.create');
    // Route::get('/pages/{slug}', Pages::class);


    Route::get('/builder/footer', FooterBuilder::class)->name('footer.builder');

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

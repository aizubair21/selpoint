<?php

namespace App\Http\Controllers\System;

use App\Http\Middleware\AbleTo;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\HandleVendor;

class VendorController extends Controller
{

    use HandleVendor;


    public function __construct()
    {
        $this->middleware(AbleTo::class . ":vendors_view")->only('viewToDashboard');
        $this->middleware(AbleTo::class . ":vendors_edit")->only('edit');

        // vendor permission for product
        $this->middleware(AbleTo::class . ":product_view")->only('productView');
        $this->middleware(AbleTo::class . ":product_add")->only('productStore');
        $this->middleware(AbleTo::class . ":product_edit")->only('productEdit');
        $this->middleware(AbleTo::class . ":product_update")->only('productUpdate');

        // vendor permission for category
        $this->middleware(AbleTo::class . ":category_view")->only('categoryList');
        $this->middleware(AbleTo::class . ":category_add")->only('categoryStore');
        $this->middleware(AbleTo::class . ":category_edit")->only('categoryEdit');
        $this->middleware(AbleTo::class . ":category_update")->only('categoryUpdate');

        // vendor permission for order 
    }

    public function upgradeIndex()
    {
        return view('user.pages.profile-upgrade.vendor.index');
    }
    public function upgradeCreateRequest()
    {
        return view('user.pages.profile-upgrade.vendor.create');
    }



    /**
     * Vendor list at system dashboard
     */
    public function viewToDashboard()
    {
        $perm = 'role_view';
        $vendorRequest = User::role('vendor')->paginate(50);
        return view('auth.system.vendors.index', [$vendorRequest]);
    }

    /**
     * vendor edit 
     */
    public function edit()
    {
        return view('auth.system.vendors.edit');
    }

    public function viewSettings()
    {
        // 
        return view('auth.system.vendors.settings');
    }
    public function viewProducts()
    {
        // 
        return view('auth.system.vendors.products');
    }
    public function viewOrders()
    {
        // 
        // return view('auth.system.vendors.orders');
    }
    public function viewDocuments()
    {
        // 
        return view('auth.system.vendors.documents');
    }
    public function viewCategories()
    {
        // 
        return view('auth.system.vendors.categories');
    }
}

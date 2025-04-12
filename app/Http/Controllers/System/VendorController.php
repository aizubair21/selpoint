<?php

namespace App\Http\Controllers\System;

use App\Http\Middleware\AbleTo;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\HandleVendor;
use App\Http\Middleware\Owner;
use App\Models\vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Can;

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

        // $this->middleware(Owner::class . "")->only('upgradeEdit');

        // vendor permission for order 
    }

    public function upgradeIndex()
    {
        // dd(auth()->user()->requestsToBeVendor()->where(['status' => 'Pending'])->count());
        return view('user.pages.profile-upgrade.vendor.index');
    }
    public function upgradeCreateRequest()
    {
        return view('user.pages.profile-upgrade.vendor.create');
    }
    public function upgradeStore(Request $request)
    {
        if (auth()->user()->requestsToBeVendor()->where(['status' => 'Pending'])->count()) {
            return redirect()->back()->with('info', 'One Request Has Been Pending!');
        }

        // dd($request->all());
        $request->validate([
            // unique, but ignore when upgate 
            'shop_name_en' => ['required', 'string', 'max:100', 'min:5', 'unique:vendors'],
            'shop_name_bn' => 'required',
            'phone' => ['required', 'max:11', 'min:10', 'unique:vendors'],
            'email' => [
                'required',
                'email',
                'unique:vendors'
            ],
            'country' => 'required',
            'district' => 'required',
            'upozila' => 'required',
            'village' => 'required',
            'zip' => ['required', 'integer'],
            'road_no' => 'required',
            'house_no' => 'required',
        ]);
        $request->mergeIfMissing(['user_id' => Auth::id(), 'slug' => Str::slug($request->shop_name_en)]); // slug

        $vendorId = vendor::create($request->except('_token'));
        // dd();
        return redirect()->route('upgrade.vendor.edit', ['id' => $vendorId->id]);
        // $this->vendor()->update([]);
    }

    public function upgradeEdit($id)
    {
        $data = auth()->user()->requestsToBeVendor()->find($id);

        if ($data) {
            // if ($data->status == 'Active') {
            //     # code...
            // }
            return view('user.pages.profile-upgrade.vendor.edit', compact('data'), ['vendor' => 'active']);
        } else {
            return redirect()->back()->with('info', 'You Have No Right Access!');
        }
    }

    public function upgradeUpdate()
    {
        // 
    }




    /**
     * Vendor list at system dashboard
     */
    public function viewToDashboard()
    {
        // $perm = 'role_view';
        $filter = request('filter') ?? 'Active';

        // switch ($filter) {
        //     case 'Active':
        //         # code...
        //         break;

        //     default:
        //         # code...
        //         break;
        // }
        $vendors = User::role('vendor')->paginate(50);
        return view('auth.system.vendors.index', [$vendors]);
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
        return view('auth.system.vendors.vendor.settings');
    }
    public function viewProducts()
    {
        // 
        return view('auth.system.vendors.vendor.products');
    }
    public function viewOrders()
    {
        // 
        // return view('auth.system.vendors.vendor.orders');
    }
    public function viewDocuments()
    {
        // 
        return view('auth.system.vendors.vendor.documents');
    }
    public function viewCategories()
    {
        // 
        return view('auth.system.vendors.vendor.categories');
    }
}

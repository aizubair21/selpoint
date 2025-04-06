<?php

namespace App\Http\Controllers\System;

use App\Http\Middleware\AbleTo;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware(AbleTo::class . ":vendors_view")->only('viewToDashboard');
        $this->middleware(AbleTo::class . ":vendors_edit")->only('edit');
    }


    /**
     * Vendor list at system dashboard
     */
    public function viewToDashboard()
    {

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
}

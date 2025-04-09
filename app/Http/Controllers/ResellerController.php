<?php

namespace App\Http\Controllers;

use App\HandleReseller;
use App\Http\Middleware\AbleTo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResellerController extends Controller
{
    use HandleReseller;
    public function __construct()
    {
        $this->middleware(AbleTo::class . ":product_view")->only('productIndex');
    }
}

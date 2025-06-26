<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ProductComissionController extends Controller
{
    public function distributeComissions($order_id)
    {
        /**
         * we get an cart order id
         * 
         * as parent_id of distributeComissions table
         */
    }


    /**
     * 
     */
    public function transferComissions($order_id)
    {
        $order = Order::find($order_id);
        $isResellerOrderToVendor = $order->user_type == 'reseller' ? true : false;

        if ($isResellerOrderToVendor) {

            // get cartOrder from order
            $co = $order->cartOrders;

            // loop throught
        }
    }
}

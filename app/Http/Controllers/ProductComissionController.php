<?php

namespace App\Http\Controllers;

use App\Models\DistributeComissions;
use App\Models\Order;
use App\Models\ResellerResellProfits;
use App\Models\TakeComissions;
use Illuminate\Http\Request;

class ProductComissionController extends Controller
{
    public function distributeComissions($id)
    {
        $order = Order::find($id);
        /**
         * get all distributed comissions related to this order is
         * a
         */
        try {

            TakeComissions::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);

            if ($order->user_type == 'reseller') {
                ResellerResellProfits::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);
            }

            return redirect()->back()->with('success', 'Comissions Distributed');
        } catch (\Throwable $th) {
            redirect()->back()->with('error', 'eroro distribute comissions');
        }
        // $dc = $otc->distributes()->pending()->get();

        // if ($otc) {



        //     foreach ($otc as $item) {

        //         // take system comission form vendor sotore
        //         UserWalletController::remove($order->belongs_to, $item->take_comission);

        //         // distributes
        //         foreach ($item->distributes as $distribute) {

        //             // add the balance to targeted user
        //             UserWalletController::add($distribute->user_id, $distribute->amount);
        //             $distribute->confirmed = true;
        //             $distribute->save();
        //         }

        //         $item->confirmed = true;
        //         $item->save();
        //     }
        // }
    }


    /**
     * 
     */
    public function transferResellerResellProfit($order_id)
    {
        $order = Order::find($order_id);
        $isResellerOrderToVendor = $order->user_type == 'reseller' ? true : false;

        if ($isResellerOrderToVendor) {
            $rrp = ResellerResellProfits::query()->where(['order_id' => $order_id]);
            $totalReturnableProfit = $rrp->sum('profit');

            // cut the balance from vendor
            $res = UserWalletController::remove($order->belongs_to, $totalReturnableProfit);
            if ($res['success']) {

                // add balance to reseller
                $res = UserWalletController::add($order->user_id, $totalReturnableProfit);
            }

            // udpate confirmed
            if ($res['success']) {
                $rrp->update(['confirmed' => true]);
            }
        }
    }


    /**
     * role back comissions
     */
    public function roleBackDistributedComissions($id)
    {
        $order = Order::find($id);
        try {


            TakeComissions::query()->where(['order_id' => $order->id])->confirmed()->update(['confirmed' => false]);

            if ($order->user_type == 'reseller') {
                ResellerResellProfits::query()->where(['order_id' => $order->id])->confirmed()->update(['confirmed' => false]);
            }

            return redirect()->back()->with('success', 'Roleback comission');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'error to roleback comissions');
        }
    }

    /**
     * role back a single comissions
     */
    public function roleBackComissions()
    {
        //
    }
}

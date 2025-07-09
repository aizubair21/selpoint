<?php

namespace App\Http\Controllers;

use App\Events\ProductComissions;
use App\Models\DistributeComissions;
use App\Models\Order;
use App\Models\ResellerResellProfits;
use App\Models\TakeComissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProductComissionController extends Controller
{

    public static function dispatchProductComissionsListeners($id)
    {
        // echo 'hellow';
        // logger("ProductComissionsTake Function Called");
        try {
            $orderData = Order::findOrFail($id); // get order table
            $cartOrders = $orderData->cartOrders; // a single order has multiple products.
            $buyer = User::findOrFail($orderData->user_id); // product buyer
            $seller = User::findOrFail($orderData->belongs_to); // product seller

            $shop = [];

            switch ($orderData->belongs_to_type) {
                case 'reseller':
                    // $shop = reseller::query(['user_id' => $orderData->belongs_to])->first('system_get_comission');
                    $shop = $seller?->resellerShop();
                    break;

                case 'vendor':
                    // $shop = vendor::query(['user_id' => $orderData->belongs_to])->first('system_get_comission');
                    $shop = $seller?->vendorShop();
                    break;
            }

            foreach ($cartOrders as $ord) {
                $products = $ord->product; // get the relevent products from order details
                // echo $products->id;
                $profit = ($ord->price - $ord->buying_price) * $ord->quantity; // total profit of selling product
                $comission = round(($profit * $shop->system_get_comission) / 100, 2); // system comissions take form the reseller/vendor
                $distribute = round(($comission * 30) / 100, 2);

                // calculate reseller profit from vendor if the seller is vendor
                if ($ord->user_type == 'reseller' && $ord->belongs_to_type == 'vendor') {
                    $profit = 0;
                    $p = ($ord->price - $ord->buying_price) * $ord->quantity;
                    $profit += $p;

                    $rrp = new  ResellerResellProfits();

                    DB::transaction(
                        function () use ($rrp, $ord, $profit) {
                            $rrp->forceFill(
                                [
                                    'product_id' => $ord->product_id,
                                    'order_id' => $ord->order_id,
                                    'from' => $ord->belongs_to,
                                    'buy' => $ord->buying_price,
                                    'sel' => $ord->price,
                                    'to' => $ord->user_id,
                                    'profit' => $profit,
                                    'confirmed' => false,
                                ]
                            );
                        }
                    );

                    $rrp->save();
                }
                // reseller profit end

                if ($products && $shop->system_get_comission) {

                    // take the comissions and store in databse
                    $takeComissions = new TakeComissions();
                    $takeComissions->forceFill(
                        [
                            'user_id' => $ord->belongs_to,
                            'product_id' => $products->id,
                            'order_id' => $orderData->id,
                            'buying_price' => $products->buying_price,
                            'selling_price' => $ord->total, // 
                            'take_comission' => $comission,
                            'distribute_comission' => $distribute,
                            'store' => round($comission - $distribute, 2),
                            'return' => $profit - $comission,
                            'profit' => $profit,
                            'confirmed' => false,
                            'comission_range' => $shop->system_get_comission,
                        ]
                    );

                    $takeComissions->save();

                    // distribute the comissions
                    // if $takeComissions id geet
                    if ($takeComissions->id) {

                        /**
                         * comission distributed among those ....
                         * 
                         * buyer
                         * buyer referrer user
                         * seller and 
                         * seller reffer user
                         */
                        $data = array(
                            'buyer' => $buyer,
                            'buyerRef' => $buyer->getReffOwner?->owner,
                            'seller' => $seller,
                            'sellerRef' => $seller->getReffOwner?->owner,
                        );

                        // $distributeData = array(
                        //     'product_id' => $products->id,
                        //     'order_id' => $orderData->id,
                        //     'parent_id' => $ord->id,
                        //     $data,
                        // );

                        foreach ($data as $key => $item) {
                            $dcm = new DistributeComissions();
                            $info = '';
                            $am = '';
                            $rng = '';


                            if ($key == 'buyer' || $key == 'seller') {
                                $rng = 10;
                                $am = round(($comission * $rng) / 100, 2);
                            } else {
                                $rng = 5;
                                $am = round(($comission * $rng) / 100, 2);
                            }

                            switch ($key) {
                                case 'buyer':
                                    $info = 'Purchase Product';
                                    break;
                                case 'seller':
                                    $info = 'Sel Product';
                                    break;

                                case 'buyerRef':
                                    $info = 'Ref User Purchase Product';
                                    break;

                                case 'sellerRef':
                                    $info = 'Ref Uer Sell Product';
                                    break;

                                default:
                                    $info = 'Comissions';
                                    break;
                            }


                            $dcm->forceFill(
                                [
                                    'product_id' => $products->id,
                                    'order_id' => $orderData->id,
                                    'parent_id' => $takeComissions->id,
                                    'user_id' => $item->id,
                                    'info' => $info,
                                    'range' => $rng,
                                    'amount' => $am,
                                ]
                            );



                            $dcm->save();
                        }
                    }
                }
            }
            logger("ProductComissionsTake Done");
        } catch (\Throwable $th) {
            // throw $th;
            logger("ProductComissionsTake $th");
        }
    }

    public function confirmTakeComissions($id)
    {
        $order = Order::findOrFail($id);
        if ($order) {
            $tc = TakeComissions::query()->where(['order_id' => $id])->pending()->get();

            if ($tc) {
                foreach ($tc as $item) {
                    $item->confirmed = true;
                    $item->save();
                }
            }

            if ($order->user_type == 'reseller') {
                // ResellerResellProfits::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);
                $rcp = ResellerResellProfits::query()->where(['order_id' => $order->id])->pending()->get();
                foreach ($rcp as $rcpi) {

                    $rcpi->confirmed = true;
                    $rcpi->save();
                }
            }
        }
    }


    public function confirmSingleTakeComissions($takeId)
    {
        try {
            $tc = TakeComissions::query()->where(['id' => $takeId])->pending()->get();

            if ($tc) {
                foreach ($tc as $item) {
                    $item->confirmed = true;
                    $item->save();
                }
            }

            if ($tc->order?->user_type == 'reseller') {
                // ResellerResellProfits::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);
                $rcp = ResellerResellProfits::query()->where(['order_id' => $tc->order_id])->pending()->get();
                foreach ($rcp as $rcpi) {

                    $rcpi->confirmed = true;
                    $rcpi->save();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    public function distributeComissions($id)
    {
        $distributes = DistributeComissions::query()
            ->where('order_id', $id)
            ->pending()
            ->groupBy('user_id')
            ->select('user_id', DB::raw('SUM(amount) as total_amount'))
            ->get();

        foreach ($distributes as $items) {
            UserWalletController::add($items->user_id, $items->total_amount);
        }
    }


    // public function distributeComissions($id)
    // {
    //     $order = Order::find($id);
    //     /**
    //      * get all distributed comissions related to this order is
    //      * a
    //      */
    //     try {

    //         TakeComissions::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);


    //         if ($order->user_type == 'reseller') {
    //             // ResellerResellProfits::query()->where(['order_id' => $order->id])->pending()->update(['confirmed' => true]);
    //             $rcp = ResellerResellProfits::query()->where(['order_id' => $order->id])->pending();
    //             $rcp->confirmed = true;
    //             $rcp->save();
    //         }

    //         return redirect()->back()->with('success', 'Comissions Distributed');
    //     } catch (\Throwable $th) {
    //         redirect()->back()->with('error', 'eroro distribute comissions');
    //     }
    //     // $dc = $otc->distributes()->pending()->get();

    //     // if ($otc) {



    //     //     foreach ($otc as $item) {

    //     //         // take system comission form vendor sotore
    //     //         UserWalletController::remove($order->belongs_to, $item->take_comission);

    //     //         // distributes
    //     //         foreach ($item->distributes as $distribute) {

    //     //             // add the balance to targeted user
    //     //             UserWalletController::add($distribute->user_id, $distribute->amount);
    //     //             $distribute->confirmed = true;
    //     //             $distribute->save();
    //     //         }

    //     //         $item->confirmed = true;
    //     //         $item->save();
    //     //     }
    //     // }
    // }


    /**
     * 
     */
    public function transferResellerResellProfit($order_id)
    {
        $order = Order::find($order_id);
        $isResellerOrderToVendor = $order->user_type == 'reseller' ? true : false;

        if ($isResellerOrderToVendor) {
            $rrp = ResellerResellProfits::query()->where(['order_id' => $order_id])->get();
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
        return redirect()->back();
    }


    /**
     * role back comissions
     */
    public function roleBackDistributedComissions($id)
    {
        $order = Order::find($id);
        try {


            $order = Order::find($id);
            $tc = TakeComissions::query()->where(['order_id' => $id])->confirmed()->get();
            if ($tc) {
                foreach ($tc as $item) {
                    $item->confirmed = false;
                    $item->save();
                }
            }

            if ($order->user_type == 'reseller') {
                // ResellerResellProfits::query()->where(['order_id' => $order->id])->confirmed()->update(['confirmed' => false]);
                $rcp = ResellerResellProfits::query()->where(['order_id' => $order->id])->confirmed()->get();
                foreach ($rcp as $rcpi) {

                    $rcpi->confirmed = false;
                    $rcpi->save();
                }
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


    /**
     * transfer reseller profit from vendor
     */
    public function refundResellerResellProfit($order_id)
    {
        $order = Order::find($order_id);
        $isResellerOrderToVendor = $order->user_type == 'reseller' ? true : false;
        if ($isResellerOrderToVendor) {
            $rrp = ResellerResellProfits::query()->where(['order_id' => $order_id, 'confirmed' => true])->get();
            $totalReturnableProfit = $rrp->sum('profit');

            // cut the balance from vendor
            $res = UserWalletController::add($order->belongs_to, $totalReturnableProfit);
            if ($res['success']) {

                // add balance to reseller
                $res = UserWalletController::remove($order->user_id, $totalReturnableProfit);
            }

            // udpate confirmed
            if ($res['success']) {
                $rrp->update(['confirmed' => false]);
            }
        }

        return redirect()->back();
    }
}

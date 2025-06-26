<?php

namespace App\Listeners;

use App\Events\ProductComissions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CountResellerComissions
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductComissions $event): void
    {

        $order = $event->data;

        /**
         * if this is order from reseller to vendor for reselling
         * then, reseller must take comission for seling vendor product
         */
        $profit = 0;

        if ($order->user_type == 'reseller' && $order->belongs_to_type == 'vendor') {
            // cart order
            $co = $order->cartOrders;
            foreach ($co as $item) {
                $p = ($item->price - $item->buying_price) * $item->quantity;
            }
        }
    }
}

<?php

namespace App\Livewire\Rider\Consignment;

use App\Models\cod;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('layouts.app')]
class Index extends Component
{

    #[URL]
    public $status = 'Pending';

    public function confirmOrder($order, $status)
    {
        $order = cod::findOrFail($order);
        if ($order && auth()->user()->abailCoin() >= $order->total_amount) {
            $order->status = $status;
            $order->save();

            if ($status == 'Delivered') {
                // cut due_amount from rider account, and add to seller account
                $rider = auth()->user();
                $seller = $order->order?->seller;

                if ($rider && $seller) {
                    $rider->coin -= $order->due_amount;
                    $seller->coin += $order->due_amount;

                    $rider->save();
                    $seller->save();
                }
            }
        }
    }

    public function render()
    {
        // dd(auth()->user()->abailCoin());
        $consignments = [];
        // get the consignments belongs to rider id
        $consignments = cod::where(['rider_id' => auth()->user()->id, 'status' => $this->status])->get();

        // $consignments = Order::whereHas('hasRider', function ($query) {
        //     $query->where('rider_id', auth()->user()->id)
        //         ->where('status', $this->status);
        // })->get();

        return view('livewire.rider.consignment.index', compact('consignments'));
    }
}

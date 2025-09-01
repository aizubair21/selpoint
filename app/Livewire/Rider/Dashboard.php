<?php

namespace App\Livewire\Rider;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Order;
use Livewire\Attributes\Url;
use App\Models\cod;
use Illuminate\Support\Facades\Auth;

#[layout('layouts.app')]
class Dashboard extends Component
{
    #[URL]
    public $search;
    public $orders = [], $riderInfo = [];

    public function mount()
    {
        if (auth()->user()?->requestsToBeRider() && auth()->user()?->isRider()) {
            $this->riderInfo = auth()->user()?->isRider();
        }

        // get the order those are match with active user rider info
        if ($this->riderInfo) {
            $this->orders = Order::query()->where(['delevery' => 'cash'])->where(function ($q) {
                $q->where('district', 'like', "%" . $this->riderInfo?->targeted_area . "%")
                    ->orWhere('location', 'like', "%" . $this->riderInfo?->targeted_area . "%")
                    ->orWhere('upozila', 'like', "%" . $this->riderInfo?->targeted_area . "%");
            })->accept()->get();
            // dd($this->orders);
        }
    }

    public function confirmOrder($orderId)
    {
        $order = Order::find($orderId);
        if (!auth()?->user()?->isRider()) {
            $this->dispatch('error', 'Your are not a Rider !');
            return;
        };

        if (cod::where('order_id', '=', $orderId)->accept()->exists() || cod::where('order_id', '=', $orderId)->complete()->exists() || cod::where('order_id', '=', $orderId)->pending()->exists()) {
            $this->dispatch('error', 'Already Picked !');
            return;
        }

        if ($order && $order->delevery == 'cash' && $order->status == 'Accept') {
            $rider_cm_range = auth()->user()?->isRider()?->comission;
            $system_cm = ($order->shipping * $rider_cm_range) / 100;

            // assign necessary info to cod model
            cod::create(
                [
                    'order_id' => $order->id,
                    'seller_id' => $order->belongs_to,
                    'seller_type' => $order->belongs_to_type,
                    'user_id' => $order->user_id,
                    'rider_id' => Auth::id(),

                    'amount' => $order->total,
                    'due_amount' => $order->total,
                    'total_amount' => $order->total + $system_cm,

                    'rider_amount' => $order->shipping,
                    'comission' => $rider_cm_range,

                    'system_comission' => $system_cm,
                ]
            );

            $this->dispatch('success', 'Order confirmed successfully.');
        } else {
            $this->dispatch('error', 'Order not found or already confirmed.');
        }
    }

    public function render()
    {
        return view('livewire.rider.dashboard');
    }
}

<?php

namespace App\Livewire\Reseller\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[layout('user.app')]
class Index extends Component
{
    public function render()
    {
        $orders = auth()->user()->orderToMe();
        return view('livewire.reseller.orders.index', compact('orders'));
    }
}

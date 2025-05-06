<?php

namespace App\Livewire\Vendor\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;


#[layout('layouts.app')]
class View extends Component
{
    #[URL]
    public $order;

    public $orders;

    public function mount()
    {
        $this->orders = Order::find($this->order);
    }

    public function updateStatus($status)
    {
        $this->orders->status = $status;
        $this->orders->save();
        $this->dispatch('refresh');
    }


    public function render()
    {
        return view('livewire.vendor.orders.view');
    }
}

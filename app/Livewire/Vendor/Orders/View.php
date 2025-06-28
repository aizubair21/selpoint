<?php

namespace App\Livewire\Vendor\Orders;

use App\Http\Controllers\ProductComissionController;
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

    public function computed() {
        
    }
    

    public function updateStatus($status)
    {
        if ($this->order->status != 'Accept') {
            $this->orders->status = $status;
            $this->orders->save();
            $this->dispatch('refresh');
        }

        if ($this->order->status == 'Accept') {
            $pcc = new ProductComissionController();
            $pcc->confirmTakeComissions($this->order->id);
        }
    }


    public function render()
    {
        return view('livewire.vendor.orders.view');
    }
}

<?php

namespace App\Livewire\System\Orders;

use App\Models\Order;
use App\Models\ResellerResellProfits;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Details extends Component
{
    #[URL]
    public $id, $nav = 'tab';
    public $order, $detais, $take, $resellerProfit;

    public function mount()
    {
        $this->order = Order::findOrFail($this->id);
        $this->resellerProfit = ResellerResellProfits::where(['order_id' => $this->id])->get();
    }

    public function render()
    {
        return view('livewire.system.orders.details');
    }
}

<?php

namespace App\Livewire\Reseller\Resel\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Reseller_has_order;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $data = [];
        $data = Order::where(['user_id' => auth()->user()->id, 'user_type' => 'reseller'])->orderBy('id', 'desc')->paginate(100);
        // dd($data);
        return view('livewire.reseller.resel.orders.index', compact('data'));
    }
}

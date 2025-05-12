<?php

namespace App\Livewire\Reseller\Resel\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Reseller_has_order;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    public $od;

    public function render()
    {
        $od = Reseller_has_order::where(['user_id' => auth()->user()->id])->orderBy('id', 'desc')->paginate(20);
        return view('livewire.reseller.resel.orders.index', compact('od'));
    }
}

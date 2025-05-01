<?php

namespace App\Livewire\Vendor\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithPagination;


#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $nav = 'Pending';
    public $order;

    public function mount()
    {
        $this->getData();
    }


    public function getData() {}


    public function render()
    {
        $order = auth()->user()->orderToMe()->where(['status' => $this->nav]);
        return view('livewire.vendor.orders.index', compact('order'));
    }
}

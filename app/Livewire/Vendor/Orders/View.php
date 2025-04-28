<?php

namespace App\Livewire\Vendor\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;


#[layout('layouts.app')]
class View extends Component
{
    public function render()
    {
        return view('livewire.vendor.orders.view');
    }
}

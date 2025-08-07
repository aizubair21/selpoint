<?php

namespace App\Livewire\User\Order;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Order;

#[layout('layouts.user.dash.userDash')]
class Details extends Component
{
    #[URL]
    public $id;

    public $orders;

    public function mount()
    {
        $this->orders = Order::where(['user_id' => auth()->user()->id, 'user_type' => 'user'])->find($this->id);
    }

    public function render()
    {
        return view('livewire.user.order.details');
    }
}

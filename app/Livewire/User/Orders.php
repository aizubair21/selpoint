<?php

namespace App\Livewire\User;

use App\Models\order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {
        $this->orders = order::where(['user_id' => auth()->user()->id, 'user_type' => 'user'])->get();
    }

    public function render()
    {
        return view('livewire.user.orders');
    }
}

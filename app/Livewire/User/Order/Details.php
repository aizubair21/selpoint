<?php

namespace App\Livewire\User\Order;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Order;
use Illuminate\Foundation\Exceptions\Renderer\Listener;

#[layout('layouts.user.dash.userDash')]
class Details extends Component
{
    #[URL]
    public $id;
    public $orders;

    public function mount()
    {
        $this->orders = Order::findOrFail($this->id);
        // dd($this->orders);
    }

    public function markAsReceived()
    {
        $this->orders->status = 'Delivered';
        $this->orders->save();
        $this->dispatch('close-modal', 'user-confirm-modal');
        $this->dispatch('refresh');
    }


    public function render()
    {
        return view('livewire.user.order.details');
    }
}

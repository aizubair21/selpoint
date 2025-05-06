<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;


#[layout('layouts.user.dash.userDash')]
class Orders extends Component
{
    #[URL]
    public $nav = 'Pending', $trash;
    public $orders;

    #[On('refresh')]
    public function mount()
    {
        $this->getData();
    }

    public function remove($id)
    {
        Order::where(['user_id' => auth()->user()->id, 'user_type' => 'user', 'id' => $id])->delete();
        $this->dispatch('refresh');
    }


    public function getData()
    {
        $this->orders = Order::where(['user_id' => auth()->user()->id, 'user_type' => 'user'])->get();
    }

    public function render()
    {
        return view('livewire.user.orders');
    }
}

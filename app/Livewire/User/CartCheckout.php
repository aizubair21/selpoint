<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
class CartCheckout extends Component
{
    public $carts, $qty;

    public function mount()
    {
        $this->carts = auth()->user()->myCarts;
    }

    public function updateQuantity($cartId, $qty)
    {
        $this->carts->find($cartId)->update(['qty' => $qty]);
    }


    public function render()
    {
        return view('livewire.user.cart-checkout');
    }
}

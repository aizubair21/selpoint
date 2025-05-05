<?php

namespace App\Livewire\User;

use App\Models\cart;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\order;

#[layout('layouts.user.dash.userDash')]
class CartCheckout extends Component
{
    public $carts, $qty = [], $tp = 0, $q = 0;

    #[On('refresh')]
    public function mount()
    {
        // dd(cart::where(['user_id' => auth()->user()->id])->select('carts.*')->groupBy('belongs_to')->get()->toArray());
        $this->carts = auth()->user()->myCarts->toArray();
        $this->tp = 0;
        $this->q = 0;
        foreach ($this->carts as $key => $cart) {
            $p = $cart['qty'] * $cart['price'];
            $this->q += $cart['qty'];
            $this->tp += $p;
        }
    }

    public function increaseQuantity($cartId)
    {
        auth()->user()->myCarts()->find($cartId)->increment('qty');
        auth()->user()->myCarts()->find($cartId)->save();
        $this->dispatch('refresh');
    }
    public function decreaseQuantity($cartId)
    {
        if (auth()->user()->myCarts()->find($cartId)->qty == 1) {
            auth()->user()->myCarts()->find($cartId)->delete();
        } else {

            auth()->user()->myCarts()->find($cartId)->decrement('qty');
            auth()->user()->myCarts()->find($cartId)->save();
        }
        $this->dispatch('refresh');
        // dd($this->carts[0]);
        // $this->carts->find($cartId)->update(['qty' => $qty]);
    }


    public function confirm()
    {
        // $ct = 
        order::create(
            [
                'user_id' => auth()->user()->id,
                'user_type' => 'user',
                // 'belongs_to' => $this->product?->user_id,
                'belongs_to_type' => 'reseller',
                'status' => 'Pending',
                // 'product_id' => $this->product?->id,
                // 'size' => $this->size ?? 'Free Size',
                'name' => 'Cart Order',
                'price' => $this->tp,
                'quantity' => $this->q,
                'location' => $this->location,
                'total' => $this->tp,
                // 'buying_price' => $this->product?->buying_price,
                'phone' => $this->phone,
            ]
        );
        $this->reset('name', 'phone', 'location');
        $this->dispatch('success', "Product added to order list");
    }



    public function render()
    {
        return view('livewire.user.cart-checkout');
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\cart;
use App\Models\order;
use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;

#[layout('layouts.user.app')]
class SingleProductOrder extends Component
{
    #[URL]
    public $slug;

    public $product, $size, $total, $price;

    #[validate('required')]
    public $name, $location, $phone, $quantity = 1;

    public function updated($property)
    {
        if ($property) {
            $this->total = $this->price * $this->quantity;
        }
    }


    public function mount()
    {
        // dd($this->slug);
        $this->product = Product::where(['slug' => $this->slug, 'status' => 'active', 'belongs_to_type' => 'reseller'])->first();
        $this->price = $this->product?->offer_type ? $this->product?->discount : $this->product?->price;
        $this->total = $this->price;
        // if (!$this->product) {
        //     return redirect('/');
        // }
    }

    public function confirm()
    {
        $this->validate();

        order::create(
            [
                'user_id' => auth()->user()->id,
                'user_type' => 'user',
                'belongs_to' => $this->product?->user_id,
                'belongs_to_type' => 'reseller',
                'status' => 'Pending',
                'product_id' => $this->product?->id,
                'size' => $this->size ?? 'Free Size',
                'name' => $this->name,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'location' => $this->location,
                'total' => $this->total,
                'buying_price' => $this->product?->buying_price,
                'phone' => $this->phone,
            ]
        );
        $this->reset('name', 'phone', 'location');
        $this->dispatch('success', "Product added to order list");
    }


    public function render()
    {
        return view('livewire.pages.single-product-order');
    }
}

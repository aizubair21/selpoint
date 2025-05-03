<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use App\Models\Cart;

#[layout('layouts.user.app')]
class ProductsDetails extends Component
{
    #[URL]
    public $slug;

    public $product, $relatedProduct;

    public function mount()
    {
        $this->getData();
        $this->relatedProduct = Product::where(['category_id' => $this->product->category_id, 'status' => 'active', 'belongs_to_type' => 'reseller'])->limit(10)->get();
    }


    public function getData()
    {
        $this->product = Product::where(['slug' => $this->slug, 'status' => 'active', 'belongs_to_type' => 'reseller'])->first();
    }

    public function addToCart()
    {
        $isAlreadyInCart = auth()->user()->myCarts()->exists(['product_id' => $this->product->id]);
        if ($isAlreadyInCart) {
            $this->dispatch('info', 'Product already in cart');
        } else {
            cart::create(
                [
                    'product_id' => $this->product->id,
                    'user_id' => auth()->user()->id,
                    'user_type' => 'user',
                    'belongs_to' => $this->product->user_id,
                    'belongs_to_type' => 'reseller',
                ]
            );

            $count = auth()->user()->myCarts()->count();
            // dd($isAlreadyInCart);
            $this->dispatch('cart', $count);
            $this->dispatch('success', 'Product Added to cart');
        }
    }

    public function render()
    {
        return view('livewire.pages.products-details');
    }
}

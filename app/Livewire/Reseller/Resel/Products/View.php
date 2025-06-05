<?php

namespace App\Livewire\Reseller\Resel\Products;

use App\Models\Product;
use App\Models\Reseller_resel_product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class View extends Component
{
    #[URL]
    public $pd;
    public $products, $confirmResel = false, $confirmOrder, $forResel = [], $reselPrice;

    public function mount()
    {
        $this->products = Product::where(['belongs_to_type' => 'vendor', 'id' => $this->pd, 'status' => 'Active'])->first();
        $this->forResel = $this->products->only('name', 'title', 'slug', 'description', 'thunbnail');
        $this->reselPrice = $this->forResel['price'];
        if (!$this->products) {
            return redirect()->back();
        }
    }

    public function confirmClone()
    {
        // clone product basic info
        $this->forResel['user_id'] = auth()->user()->id;
        $this->forResel['belongs_to_type'] = 'reseller';
        $this->forResel['buying_price'] = $this->products->price;
        $this->forResel['unit'] = 10;
        $this->forResel['price'] = $this->reselPrice;
        $this->forResel['category_id'] = 'resel';
        $this->forResel['status'] = 'Active';

        // save as new to reseller
        $newProduct = Product::create($this->forResel);

        // create link to track reseller, vendor and product
        Reseller_resel_product::create(
            [
                'user_id' => Auth::id(),
                'belongs_to' => $this->products->user_id,
                'product_id' => $newProduct->id,
            ]
        );
    }


    public function render()
    {
        return view('livewire.reseller.resel.products.view');
    }
}

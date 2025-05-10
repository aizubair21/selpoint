<?php

namespace App\Livewire\Reseller\Resel\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class View extends Component
{
    #[URL]
    public $pd;
    public $products;

    public function mount()
    {
        $this->products = Product::where(['belongs_to_type' => 'vendor', 'id' => $this->pd, 'status' => 'Active'])->first();
        // dd($this->products->owner);
        if (!$this->products) {
            return redirect()->back();
        }
    }

    public function downImage($imagePath)
    {
        dd('alsdfas');
    }


    public function render()
    {
        return view('livewire.reseller.resel.products.view');
    }
}

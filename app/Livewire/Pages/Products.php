<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public function mount()
    {
        // 
    }

    public function render()
    {
        $products = Product::where(['belongs_to_type' => 'reseller'])->paginate(20);
        return view('livewire.pages.products', compact('products'));
    }
}

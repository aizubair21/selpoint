<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[layout('layouts.user.app')]
class Products extends Component
{
    use WithPagination;

    public $cart;
    // protected refresh 
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $products = Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->paginate(20);
        // dd($products);
        return view('livewire.pages.products', compact('products'));
    }
}

<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;

class RecomendedProducts extends Component
{
    public $data = [];

    public function mount()
    {
        
        $this->data = Product::query()->reseller()->active()->home()->orderBy('vc')->limit(20)->get();
        // dd($this->data);
    }
    public function render()
    {
        return view('livewire.pages.recomended-products');
    }
}

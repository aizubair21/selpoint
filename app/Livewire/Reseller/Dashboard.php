<?php

namespace App\Livewire\Reseller;

use App\Models\Product;
use Livewire\Component;

class Dashboard extends Component
{
    public $products = [], $category = [], $vendor = [], $trands = [];

    public function mount()
    {
        $this->getDate();
    }


    public function getDate()
    {
        $this->products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->limit('50')->get();
        // dd($this->products);
    }


    public function render()
    {
        return view('livewire.reseller.dashboard');
    }
}

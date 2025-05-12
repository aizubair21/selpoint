<?php

namespace App\Livewire\Reseller;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\vendor;

class Dashboard extends Component
{
    public $products = [], $tp = [],  $category = [], $vendor = [], $trands;

    public function mount()
    {
        $this->getDate();
    }


    public function getDate()
    {
        $this->products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->limit('50')->get();
        $this->tp = Product::where(['belongs_to_type' => 'vendor'])->count();
        $this->vendor = vendor::count();
        $this->category = Category::where(['belongs_to' => 'vendor'])->count();
        // dd($this->products);
    }


    public function render()
    {
        return view('livewire.reseller.dashboard');
    }
}

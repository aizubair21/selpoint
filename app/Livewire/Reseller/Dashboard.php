<?php

namespace App\Livewire\Reseller;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\vendor;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $products = [], $tp,  $category, $vendor, $trands;

    public function mount()
    {

        $this->tp = Product::where(['belongs_to_type' => 'vendor'])->count();
        $this->vendor = vendor::count();
    }

    public function getData()
    {
        // dd($this->products);
    }


    public function render()
    {
        return view('livewire.reseller.dashboard', 
    [
        'products' => Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->paginate(100),
    ]);
    }
}

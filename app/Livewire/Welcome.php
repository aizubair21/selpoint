<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;



#[layout('layouts.user.app')]
class Welcome extends Component
{

    public $products;

    public function mount()
    {
        $this->products =  Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->orderBy('id', 'desc')->limit(20)->get();
    }

    public function render()
    {
        return view('livewire.welcome');
    }
}

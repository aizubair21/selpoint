<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Slider_has_slide;
use Livewire\Attributes\Computed;

#[layout('layouts.user.app')]
class Welcome extends Component
{

    public $products = [], $categories = [];

    public function getProducts()
    {
        $this->products =  Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->orderBy('id', 'desc')->limit(20)->get();
        $this->categories = Category::getAll();
    }

    public function render()
    {

        return view('livewire.welcome');
    }
}

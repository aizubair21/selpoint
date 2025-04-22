<?php

namespace App\Livewire\Vendor\Products;

use App\Models\product;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;


    public $selectedModel = [], $nav = 'Active', $serarch;
    public $products, $ap, $dp, $tp;


    public function mount()
    {
        $this->getData();
    }

    public function computed() {}

    public function getData()
    {
        //     
        $this->products = Product::all();

        if ($this->nav == 'trash') {
            //
        }

        if ($this->nav == 'draft') {
            // 
        }
    }

    public function search()
    {
        $this->products = product::where('title', 'like', '%' . $this->search . "%")->orwhere('name', 'like', '%' . $this->search . "%")->get();
    }



    public function render()
    {


        return view('livewire.vendor.products.index');
    }
}

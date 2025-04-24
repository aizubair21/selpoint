<?php

namespace App\Livewire\Vendor\Products;

use App\Models\product;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[URL]
    public $search, $nav = 'Active';


    public $selectedModel = [];
    public $ap, $dp, $tp;


    public function mount()
    {
        $this->getData();
        // dd($this->products);
    }

    public function computed() {}

    public function getData() {}

    public function search() {}



    public function render()
    {

        //     
        $products = Product::query()->paginate(200);

        if ($this->nav == 'trash') {
            //
        }

        if ($this->nav == 'draft') {
            // 
        }


        if (!empty($this->search())) {
            $products = Product::where('title', 'like', '%' . $this->search . "%")->orwhere('name', 'like', '%' . $this->search . "%")->get();
        }
        return view('livewire.vendor.products.index', compact('products'));
    }
}

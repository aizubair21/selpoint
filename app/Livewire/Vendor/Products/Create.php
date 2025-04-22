<?php

namespace App\Livewire\Vendor\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\HandleImageUpload;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

#[layout('layouts.app')]
class Create extends Component
{
    use HandleImageUpload, WithFileUploads;

    #[Validate]
    public $products = [], $thumb;

    protected function rules()
    {
        return [
            'products.name' => 'required|min:5',
            'products.title' => 'required|min:5|max:255',
            'products.category_id' => 'required',
            'products.buying_price' => 'required',
            'products.price' => 'required',
            'thumb' => 'required'
        ];
    }

    public function mount()
    {
        /**
         * if any category not fount
         * throw an warning,
         * as every product must belongs to a category
         *  */
    }


    public function create()
    {
        // $validated = $this->validate();
        // dd($this->products);
        Product::create($this->products);

        $this->dispatch('success', 'Product Created');
        $this->redirectIntended(route('vendor.products.index'), true);
    }

    public function render()
    {
        return view('livewire.vendor.products.create');
    }
}

<?php

namespace App\Livewire\Vendor\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\HandleImageUpload;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

#[layout('layouts.app')]
class Create extends Component
{
    use HandleImageUpload, WithFileUploads;

    #[Validate]
    public $products = [], $thumb, $categories, $attr = [];

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


    #[On('refresh')]
    public function mount()
    {
        $this->categories = auth()->user()->myCategory;
        /**
         * if any category not fount
         * throw an warning,
         * as every product must belongs to a category
         *  
         * */
    }



    public function create()
    {
        $this->validate();
        $data = array_merge(
            $this->products,
            [
                'slug' => Str::slug($this->products['title']),
                'thumbnail' => $this->handleImageUpload($this->thumb, 'products', null),
            ]
        );
        // dd($data);
        $pd = Product::create($data);

        $this->dispatch('success', 'Product Created');
        $this->redirectIntended(route('vendor.products.edit', ['product' => encrypt($pd->id)]), true);
    }

    public function render()
    {
        return view('livewire.vendor.products.create');
    }
}

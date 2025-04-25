<?php

namespace App\Livewire\Vendor\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;


#[layout('layouts.app')]
class Edit extends Component
{

    #[URL]
    public $product;

    public $data;
    public $products;

    public function mount()
    {
        $this->data = auth()->user()->myProducts()->find(decrypt($this->product));
        $this->products = $this->data->only(
            [
                'name',
                'title',
                'slug',
                'description',
                'price',
                'discount',
                'buying_price',
                'category_id',
                'user_id',
                'belongs_to_type',
                'thumbnail',
                'offer_type',
                'unit',
                'status',
                'display_at_home',
                'created_at'
            ]
        );
    }

    public function save()
    {
        // dd($this->data);
    }


    public function render()
    {
        return view('livewire.vendor.products.edit');
    }
}

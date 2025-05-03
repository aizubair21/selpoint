<?php

namespace App\Livewire\Vendor\Products;

use App\Models\Product;
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
    public $nav = 'Active', $take, $relatedImage = [];


    public $selectedModel = [];
    public $ap, $dp, $tp, $search;

    public function moveToTrash()
    {
        // 
        if (count($this->selectedModel) > 0) {
            auth()->user()->myProducts()->whereIn('id', $this->selectedModel)->delete();
            $this->reset('selectedModel');

            $this->dispatch('success', 'Product Move to Trash');
        }
    }
    public function restoreFromTrash()
    {
        // 
        if (count($this->selectedModel) > 0) {
            auth()->user()->myProducts()->onlyTrashed()->whereIn('id', $this->selectedModel)->restore();
            $this->reset('selectedModel');

            $this->dispatch('success', 'Product restore from Trash');
        }
    }


    public function render()
    {

        //     
        $products = auth()->user()->myProductsAsVendor()->where(['status' => $this->nav])->paginate(200);

        if ($this->take) {
            $products = auth()->user()->myProducts()->onlyTrashed()->paginate(20);
        }

        if ($this->nav == 'draft') {
            // 
        }


        if (!empty($this->search)) {
            $products = auth()->user()->myProducts()->where('title', 'like', '%' . $this->search . "%")->orwhere('name', 'like', '%' . $this->search . "%")->get();
        }
        return view('livewire.vendor.products.index', compact('products'));
    }
}

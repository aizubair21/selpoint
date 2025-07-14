<?php

namespace App\Livewire\Reseller\Resel\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[URL]
    public $cat, $search;

    public $categories, $targetCat, $viewAll = false;

    public function vieAll()
    {
        $this->cat = '';
        $this->viewAll = true;
        $this->dispatch('refresh');
        // $this->dispatch('info', 'You are viewing all product of vendor');
    }

    public function render()
    {
        $this->targetCat = Category::find($this->cat);
        $this->categories = Category::where(['belongs_to' => 'vendor'])->orderBy('id', 'desc')->get();
        $products = [];
        if ($this->cat) {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active', 'category_id' => $this->cat])->orderBy('id', 'desc')->paginate(50);
        } else {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->orderBy('id', 'desc')->paginate(50);
        }
        if ($this->viewAll) {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->orderBy('id', 'desc')->paginate(50);
        }
        return view('livewire.reseller.resel.products.index', compact('products'));
    }
}

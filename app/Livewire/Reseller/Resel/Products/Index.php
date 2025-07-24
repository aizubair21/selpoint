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
    public $cat, $search, $ids = [];

    public $categories, $targetCat, $viewAll = false;

    public function mount()
    {
        if ($this->cat) {

            $catId = Category::where(['id' => $this->cat])->first();
            array_push($this->ids, $catId->id);

            $this->pslug($catId);
            // dd($this->ids);
        }
    }


    public function vieAll()
    {
        $this->cat = '';
        $this->viewAll = true;
        $this->dispatch('refresh');
        // $this->dispatch('info', 'You are viewing all product of vendor');
    }

    private function pslug($elem)
    {
        // array_push($this->ids, $elem->id);
        // $em = $elem->children;
        if ($elem->children) {
            foreach ($elem->children as $child) {
                array_push($this->ids, $child->id);
                $this->pslug($child);
            }
        } else {
            array_push($this->ids, $elem->id);
        }
    }

    public function render()
    {
        $this->targetCat = Category::find($this->cat);
        $this->categories = Category::getAll();
        $products = [];
        if ($this->cat) {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->whereIn('category_id', $this->ids)->orderBy('id', 'desc')->paginate(50);
        } else {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->orderBy('id', 'desc')->paginate(50);
        }
        if ($this->viewAll) {
            $products = Product::where(['belongs_to_type' => 'vendor', 'status' => 'Active'])->orderBy('id', 'desc')->paginate(50);
        }
        return view('livewire.reseller.resel.products.index', compact('products'));
    }
}

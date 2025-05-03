<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use App\Models\Product;
use Livewire\WithPagination;



#[layout('layouts.user.app')]
class Cproducts extends Component
{
    use WithPagination;

    #[URL]
    public $cat;


    public function render()
    {
        $catId = Category::where(['name' => $this->cat])->get('id')->value('id');
        $products = Product::where(['category_id' => $catId])->paginate(20);
        return view('livewire.pages.cproducts', compact('products'));
    }
}

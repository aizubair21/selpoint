<?php

namespace App\Livewire;

use App\Jobs\UpdateProductSalesIndex;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Slider_has_slide;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;


#[layout('layouts.user.app')]
class Welcome extends Component
{
    public $products = [], $categories = [], $topSellingProducts = [], $displayAtHome = [];

    public  function mount()
    {
        $this->products =  Product::query()->reseller()->active()->orderBy('id', 'desc')->limit(20)->get();
        $this->categories = Category::getAll();
    }
    public function getProducts()
    {
        $this->topSellingProducts = DB::table('cart_orders')
            ->where('user_type', '=', 'user')
            ->leftJoin('products', 'products.id', '=', 'product_id')
            ->select('product_id', 'products.*', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(20)
            ->get();
        // dd($topSellingProducts);

        // UpdateProductSalesIndex::dispatch();

        $this->displayAtHome = Product::query()->reseller()->active()->home()->orderBy('id', 'desc')->limit(20)->get();
    }

    public function render()
    {

        return view('livewire.welcome');
    }
}

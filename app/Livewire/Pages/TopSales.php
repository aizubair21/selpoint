<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Models\productSalesIndex;
use Livewire\Component;

class TopSales extends Component
{
    public $topSales;

    public function mount()
    {
        $this->topSales = productSalesIndex::query()->orderBy('total_sales', 'desc')->limit(20)->get();
        // $this->topSales = Product::whereIn('id', $ids)->get();
    }

    public function render()
    {
        return view('livewire.pages.top-sales');
    }
}

<?php

namespace App\Livewire\Reseller\Products;

use App\Models\Product;
use App\Models\Reseller_resel_product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $nav = 'own', $pd = 'Active';


    public function render()
    {
        $data = [];

        if ($this->nav == 'own') {
            $data = auth()->user()->myProducts()->paginate(50);
        }

        if ($this->nav == 'resel') {
            $rl = Reseller_resel_product::where(['user_id' => Auth::id()])->pluck('product_id');
            $data = Product::whereIn('id', $rl)->paginate(50);
        }

        return view('livewire.reseller.products.index', compact('data'));
    }
}

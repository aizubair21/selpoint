<?php

namespace App\Livewire\Pages\Shops;

use App\Models\reseller;
use Livewire\Component;

class ShopList extends Component
{
    public function render()
    {
        $shops = reseller::where('status', 'Active')->get();
        return view('livewire.pages.shops.shop-list', compact('shops'));
    }
}

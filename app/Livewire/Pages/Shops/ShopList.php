<?php

namespace App\Livewire\Pages\Shops;

use App\Models\reseller;
use Livewire\Component;
use Illuminate\Support\Str;

class ShopList extends Component
{
    public function render()
    {
        $shops = reseller::where(['country' => Str::ucfirst(auth()?->user()?->country), 'status' => 'Active'])->get();
        return view('livewire.pages.shops.shop-list', compact('shops'));
    }
}
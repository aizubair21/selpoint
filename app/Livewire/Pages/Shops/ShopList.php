<?php

namespace App\Livewire\Pages\Shops;

use App\Models\reseller;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class ShopList extends Component
{
    public function render()
    {

        $q = reseller::query();
        if (Auth::check()) {
            $shops = $q->where(['country' => auth()->user()?->country, 'status' => 'Active'])->paginate(config('app.paginate'));
        }
        $shops = [];
        return view('livewire.pages.shops.shop-list', compact('shops'));
    }
}

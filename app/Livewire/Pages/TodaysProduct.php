<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;

class TodaysProduct extends Component
{
    public function render()
    {
        return view(
            'livewire.pages.todays-product',
            [
                'products' => Product::whereDate(['created_at' => now()->endOfDay()])->orderBy('vc')->limit(20),
            ]
        );
    }
}

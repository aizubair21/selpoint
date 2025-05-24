<?php

namespace App\Livewire\System\Store;

use Livewire\Component;
use App\Models\Store;

class DonationStore extends Component
{
    public function render()
    {
        $store = Store::query()->donation()->first();

        return view('livewire.system.store.donation-store', compact('store'));
    }
}

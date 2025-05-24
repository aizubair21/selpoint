<?php

namespace App\Livewire\System\Store;

use Livewire\Component;
use App\Models\Store;

class CoastStore extends Component
{
    public function render()
    {
        $store = Store::query()->cost()->first();
        return view('livewire.system.store.coast-store', compact('store'));
    }
}

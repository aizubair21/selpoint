<?php

namespace App\Livewire\Pages\Shops;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.app')]
class All extends Component
{
    public function render()
    {
        return view('livewire.pages.shops.all');
    }
}

<?php

namespace App\Livewire\Vendor\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.vendor.categories.index');
    }
}

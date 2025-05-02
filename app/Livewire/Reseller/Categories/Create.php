<?php

namespace App\Livewire\Reseller\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;


#[layout('layouts.app')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.reseller.categories.create');
    }
}

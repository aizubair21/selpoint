<?php

namespace App\Livewire\Reseller\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;


#[layout('layouts.app')]
class Index extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = auth()->user()->myCategory();
    }

    public function render()
    {
        return view('livewire.reseller.categories.index');
    }
}

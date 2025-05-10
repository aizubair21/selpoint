<?php

namespace App\Livewire\Reseller\Resel;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.app')]
class Categories extends Component
{
    public $categories;

    public function mount()
    {

        $this->categories = Category::where(['belongs_to' => 'vendor'])->get();
    }

    public function render()
    {
        return view('livewire.reseller.resel.categories');
    }
}

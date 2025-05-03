<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;


#[layout('layouts.user.app')]
class Categories extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::where(['belongs_to' => 'reseller'])->get();;
    }

    public function render()
    {
        return view('livewire.pages.categories');
    }
}

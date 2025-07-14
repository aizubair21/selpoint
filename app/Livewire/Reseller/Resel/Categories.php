<?php

namespace App\Livewire\Reseller\Resel;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Categories extends Component
{
    #[URL]
    public $cat;
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

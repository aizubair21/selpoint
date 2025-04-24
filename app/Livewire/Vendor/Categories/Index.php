<?php

namespace App\Livewire\Vendor\Categories;

use App\Models\category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;


#[layout('layouts.app')]
class Index extends Component
{
    public $categories, $account;

    public function mount()
    {
        $this->account = auth()->user()->isVendor() ? 'vendor' : 'reseller';
        $this->getData();
    }

    #[On('refresh')]
    public function getData()
    {
        $this->categories = auth()->user()->myCategory;
    }


    public function render()
    {
        return view('livewire.vendor.categories.index');
    }
}

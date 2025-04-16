<?php

namespace App\Livewire\System\Products;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class Index extends Component
{
    #[URL]
    public $id, $filter = 'Active', $get_from = 'vendor';

    public $data;

    public function mount()
    {
        $this->getData();
    }


    public function getData()
    {
        //     
    }


    public function render()
    {
        return view('livewire.system.products.index')->layout('layouts.app');
    }
}

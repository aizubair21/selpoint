<?php

namespace App\Livewire\Reseller\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;


#[layout('layouts.app')]
class Index extends Component
{

    #[URL]
    public $nav = 'own', $pd = 'Active';


    public function render()
    {
        return view('livewire.reseller.products.index');
    }
}

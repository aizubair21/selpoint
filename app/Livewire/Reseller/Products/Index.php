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
        $data = auth()->user()->myProductsAsReseller;

        return view('livewire.reseller.products.index', compact('data'));
    }
}

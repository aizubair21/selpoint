<?php

namespace App\Livewire\System\Resellers;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class Index extends Component
{
    #[URL]
    public $filter = 'Active';

    public $resellers;

    public function mount() 
    {
        //    
    }
    

    public function getDate() {}


    public function render()
    {
        return view('livewire.system.resellers.index')->layout('layouts.app');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[layout('layouts.user.app')]
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome');
    }
}

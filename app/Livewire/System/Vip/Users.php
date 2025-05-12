<?php

namespace App\Livewire\System\Vip;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.app')]
class Users extends Component
{
    public function render()
    {
        return view('livewire.system.vip.users');
    }
}

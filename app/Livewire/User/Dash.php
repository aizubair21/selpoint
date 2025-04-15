<?php

namespace App\Livewire\User;

use Livewire\Component;

class Dash extends Component
{
    public function render()
    {
        return view('livewire.user.dash')->layout('layouts.user.dash.userDash');
    }
}

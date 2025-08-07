<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.profile.edit');
    }
}

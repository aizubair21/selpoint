<?php

namespace App\Livewire\User\Upgrade\Rider;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout("layouts.user.dash.userDash")]
class Edit extends Component
{
    public function render()
    {
        return view('livewire..user.upgrade.rider.edit');
    }
}

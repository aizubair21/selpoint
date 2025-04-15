<?php

namespace App\Livewire\User\Upgrade\Vendor;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.user.upgrade.vendor.create')->layout('layouts.user.dash.userDash');
    }
}

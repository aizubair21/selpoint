<?php

namespace App\Livewire\User\Upgrade\Vendor;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.upgrade.vendor.index')->layout('layouts.user.dash.userDash');
    }
}

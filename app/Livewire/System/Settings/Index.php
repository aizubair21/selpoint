<?php

namespace App\Livewire\System\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.system.settings.index');
    }
}

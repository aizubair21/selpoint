<?php

namespace App\Livewire\System\Resellers;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class Edit extends Component
{
    #[URL]
    public $id, $nav = 'documents';

    public $resellers;

    public function render()
    {
        return view('livewire.system.resellers.edit')->layout('layouts.app');
    }
}

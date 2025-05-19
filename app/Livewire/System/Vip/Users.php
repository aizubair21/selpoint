<?php

namespace App\Livewire\System\Vip;

use App\Models\vip;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Users extends Component
{
    #[URL]
    public $nav = 'Pending', $search = '';

    public $vip;

    public function mount()
    {
        $this->vip = vip::where(['status' => $this->nav == 'Pending' ? 0 : 1])->get();
    }

    public function render()
    {
        return view('livewire.system.vip.users');
    }
}

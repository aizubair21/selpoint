<?php

namespace App\Livewire\System\Users;

use App\Models\User;
use App\Models\vendor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Edit extends Component
{
    #[URL]
    public $email;

    public $user;

    public function mount()
    {
        $this->user = User::where(['email' => $this->email])->first();
        // dd($this->user);
    }

    public function render()
    {
        return view('livewire.system.users.edit');
    }
}

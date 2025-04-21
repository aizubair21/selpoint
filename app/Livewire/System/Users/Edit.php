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
    public $id;

    public $users, $user, $cref;

    public function mount()
    {
        $this->user = User::find($this->id);
        $this->users = $this->user->toArray();
        // dd($this->user);
    }

    public function render()
    {
        return view('livewire.system.users.edit');
    }
}

<?php

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.user.dash.userDash')] class extends Component 
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="alert alert-danger">
        Are you sure to logout from your current session. 
        <br>
        <x-danger-button wire:click="logout">
            {{ __('Log Out') }}
        </x-danger-button>
    </div>
</div>

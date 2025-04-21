<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;


new class extends Component {
    public $user, $userRoles = [], $roles;


    public function mount() 
    {
        $this->userRoles  = $this->user->getRoleNames()->toArray();
        $this->roles = role::all();


        // dd($this->userRoles);
    }


    public function save() 
    {
        // dd($this->userRoles);
        // $this->user->removeRole($this->userRoles);
        $this->user->syncRoles($this->userRoles);    
        $this->dispatch('refres');
        $this->dispatch('success', 'Role Attached');
    }
    
    
}; 

?>

<div>
    <form wire:submit.prevent="save">
        <div>   
            <x-input-file label="User Role" error="role" name="role" >
                @foreach ($roles as $item)
                    <div class="flex items-center space-y-2">
                  
                        <x-text-input type="checkbox" wire:model.live="role" wire:model.live="userRoles" value="{{$item->name}}" />
                        <x-input-label class="pl-3 text-md" value="{{$item->name}}" />
                        
                    </div>
                @endforeach
                <x-hr/>
                <x-primary-button>
                    save
                </x-primary-button>
            </x-input-file>
        </div>
    </form>
</div>

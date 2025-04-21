<div>
    <x-dashboard.container x-data="{nav : 'profile'}">
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{$user->name}}
                </x-slot>
                <x-slot name="content">
                    
                    <div>
                        <x-nav-link @click="nav = 'profile'">Profile</x-nav-link>
                        <x-nav-link @click="nav = 'role'" >Permission</x-nav-link>
                        <x-nav-link @click="nav = 'vip'" >vip</x-nav-link>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <x-dashboard.section x-show="nav == 'profile'">
            <x-dashboard.section.inner>
                
               @livewire('system.users.partials.update-profile-information', ['user' => $user], key($user->id))
                    
                <x-hr/>
                    <x-input-file label="User Coin" error="coin" name="coin" >
                        <x-text-input type="text" class="w-full" wire:model.live="users.coin"/>
                    </x-input-file>
                <x-hr/>
                    
            </x-dashboard.section.inner>
        </x-dashboard.section>


        <x-dashboard.section x-show="nav == 'role'">
            <x-dashboard.section.inner>
                @livewire('system.users.partials.update-profile-role', ['user' => $user], key($user->id))
                <x-hr/>
                <div class="">
                    <x-input-label style="width:250px" class="mb-4">
                        User Permission
                    </x-input-label>
                    @livewire('system.users.partials.update-profile-permission', ['user' => $user], key($user->id))
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>
       
        
    </x-dashboard.container>
   
</div>


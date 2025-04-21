<div>

   {{-- @includeIf('auth.system.users.edit'); --}}
    <x-dashboard.container x-data="{nav : 'profile'}">
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Update User Profile
                </x-slot>
                <x-slot name="content">
                    
                    <div>
                        <x-nav-link @click="nav = 'profile'">Profile</x-nav-link>
                        <x-nav-link @click="nav = 'role'" >Role and Permission</x-nav-link>
                        <x-nav-link @click="nav = 'vip'" >vip</x-nav-link>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <x-dashboard.section x-show="nav == 'profile'">
            <x-dashboard.section.inner>
                
                <form wire:submit.prevent="update   ">

                    <div class=" m-0">
                        
             
                        <x-input-file label="User Name" error="name" name="name" >
                            <x-text-input type="text" class="w-full" wire:model.live="users.name"/>
                        </x-input-file>
                        <x-hr/>
                        <x-input-file label="User Email" error="email" name="email" >
                            <x-text-input type="text" class="w-full" wire:model.live="users.email"/>
                        </x-input-file>
                        <x-hr/>
                        <x-input-file label="User Reference" error="reference" name="reference" >
                            @if (!empty($users['reference']))
                                Accept ref by <strong> {{$user->getReffOwner?->owner?->name ?? "Not Found"}} </strong>
                            @endif
                            <x-text-input :disabled="true" type="text" class="w-full" wire:model.live="users.reference"/>
                            <div class="p-2 rounded border border-slate-600 mt-3 shadow-sm">
                                {{-- <x-primary-button wire:click="addReference" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Reference</x-primary-button> --}}
                                <div class=" items-center my-2 border p-2 rounded ">
                                    <x-input-label for="new_ref">Custom Ref</x-input-label>
                                    <x-text-input type="text"  placeholder="Write custom referred code " id="new_ref" wire:model.live="users.reference" />
                                </div>
                                <hr>
                                <div class="flex items-start my-2">
                                    <x-text-input type="checkbox" id="reference" wire:model.live="users.reference" value="{{config('app.ref')}}" style="width:25px; height:25px; margin-right:25px" id="" />
                                    <div>
                                        <p class="bold font-bold fw-bold m-0" for="reference">Set Default Admin Ref</p>
                                        <h6>
                                            In case of set the admin default ref, please check the box.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <x-hr/>
                            <x-primary-button>
                                Update User
                            </x-primary-button>
                        </x-input-file>

                        </div>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Update User</button> --}}
                </form>
                    
                <x-hr/>
                    <x-input-file label="User Coin" error="coin" name="coin" >
                        <x-text-input type="text" class="w-full" wire:model.live="users.coin"/>
                    </x-input-file>
                <x-hr/>
                    {{-- <x-input-file label="User Role" error="role" name="role" >
                        @php
                            $id = $user->id;
                            $type = 'user';
                        @endphp
                        @include('components.dashboard.role-to-user', ['id' => $id, 'type' => $type])
                    </x-input-file>
                <x-hr/> --}}
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
   
</div>


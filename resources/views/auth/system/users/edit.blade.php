<x-app-layout>
    <x-dashboard.page-header>
        User Update
    </x-dashboard.page-header>

    <x-dashboard.container>

        {{-- <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    profile Infomation
                </x-slot>
                <x-slot name="content">
                   Update users profile information and email address
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section> --}}

        <form action="" method="post">
            @csrf
            <x-dashboard.section>
                <div class="row m-0">
                    <div class="col-lg-6">
                        <x-dashboard.section.inner>
                            <x-input-label>
                                Name
                            </x-input-label>
                            <x-text-input name="name" value="{{$user->name}}" autofocus class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            
        
                            <x-input-label>
                                Email
                            </x-input-label>
                            <x-text-input name="email" value="{{$user->email}}" autofocus class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            
                                <x-primary-button>
                                    Save
                                </x-primary-button> 
                            </x-dashboard.section.inner>
                        </div>
                    <div class="col-lg-6">
                        <x-dashboard.section.inner>
                            <x-input-label value="Phone" />
                            <x-text-input name="phone" value="{{$user->phone}}" autofocus class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />

                            <x-input-label value="Reference" />
                            <x-text-input name="reference" value="{{$user->reference}}" autofocus class="w-full " />
                            <x-input-error class="mt-2" :messages="$errors->get('reference')" />

                            <x-input-label value="Coin" />
                            <x-text-input name="coin" value="{{$user->coin}}" autofocus class="w-full " />
                            <x-input-error class="mt-2" :messages="$errors->get('coin')" />
                        </x-dashboard.section.inner>
                    </div>
                </div>
             
            </x-dashboard.section>
        </form>
    </x-dashboard.container>

    <x-dashboard.container>
        
        <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Profile Upgradetion
                    </x-slot>
                    <x-slot name="content">
                        Define user role and given permissions for certain tasks
                    </x-slot>
                </x-dashboard.section.header>
                
                <x-dashboard.section.inner>
                    
                    
                    <div class="space-x-2 space-y-2">
                        <div class="border p-2 rounded mb-3">
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Role
                                </x-slot>
                                <x-slot name="content">
                                    
                                </x-slot>
                            </x-dashboard.section.header>
                          
                            @php
                                
                                $id = $user->id;
                                $type = 'user';
                            @endphp
                            @include('components.dashboard.role-to-user', ['id' => $id, 'type' => $type])
                            {{-- <x.dashboard.role-to-user id="  {{$user->id}}"  type="user"/> --}}

                        </div>

                        <div class="border rounded p-2 mb-3">
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Permissions
                                </x-slot>
                                <x-slot name="content">
                                </x-slot>
                            </x-dashboard.section.header>
                            <form action="{{route('system.permissions.to-user', ['user' => $user->id])}}" method="post">
                                @csrf
                                <input type="hidden" name="user" value="{{$user->id}}">
                               
                                @php
                                    $userPermissions = $user->getPermissionNames();
                                @endphp
                            
                                {{-- <x-permissions-to-user /> --}}
                                @include('components.permissions-to-user')
                                <x-primary-button>
                                    save
                                </x-primary-button>
                            </form>
                        </div>
                    </div>

                </x-dashboard.section.inner>
            </x-dashboard.section>

    </x-dashboard.container>
</x-app-layout>
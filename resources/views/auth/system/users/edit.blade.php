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
            
                            </x-dashboard.section.inner>
                        </div>
                    <div class="col-lg-6">
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
                    </div>
                </div>
                
            </x-dashboard.section>
      
    </x-dashboard.container>
    
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Update User Profile
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                {{-- <x-input-label value="Phone" />
                <x-text-input name="phone" value="{{$user->phone}}" autofocus class="w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        
                <x-input-label value="Reference" />
                <x-text-input name="reference" value="{{$user->reference}}" autofocus class="w-full " />
                <x-input-error class="mt-2" :messages="$errors->get('reference')" />
        
                <x-input-label value="Coin" />
                <x-text-input name="coin" value="{{$user->coin}}" autofocus class="w-full " />
                <x-input-error class="mt-2" :messages="$errors->get('coin')" /> --}}
                <form action="{{ route('system.users.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="row m-0 px-2">
                        <div class="col-12 p-1">
                            <div class="my-1 bg-white p-2">
                                {{-- <x-text-input type="text" name="" class="form-control" disabled readonly value="{{$user->name . " - " . $user->email}}" id="" /> --}}
                            </div>
                        </div>
                        <div class="col-md-4 p-1">
                            <div class="bg-white p-2 rounded">
            
                                <div class="form-group">
                                    <x-input-label for="name">Name</x-input-label>
                                    <x-text-input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required />
                                </div>
                                <div class="form-group">
                                    <x-input-label for="email">Email</x-input-label>
                                    <x-text-input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required />
                                </div>
                                <div class="form-group">
                                    <x-input-label for="password">Password (leave blank to keep current password)</x-input-label>
                                    <x-text-input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="form-group">
                                    <x-input-label for="password_confirmation">Confirm Password</x-input-label>
                                    <x-text-input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-1">
                            <div class="bg-white p-2 rounded ">
                                <h4>Referred</h4>
                                <hr>
            
                                @if ($user->reference)
                                    Accept ref by <strong> {{$user->getReffOwner?->owner?->name ?? "Not Found"}} </strong>
                                @endif
            
                                <div class="input-group">
                                    <x-input-label class="input-group-text">USER REF</x-input-label>
                                    <x-text-input type="text" class="form-control bg-white" disabled readonly value="{{$user->reference ?? "No Ref" }}" />
                                </div>
                                <hr>
                                <div class="d-fle align-items-center my-2 border p-2 rounded ">
                                    <x-input-label for="new_ref">Custom Ref</x-input-label>
                                    <x-text-input type="text" class="form-control"  placeholder="Write custom referred code " id="new_ref" name="reference" />
                                </div>
                                <hr>
                                <div class="d-flex align-items-start my-2">
                                    <x-text-input type="checkbox" id="reference" name="reference" value="{{config('app.ref')}}" style="width:25px; height:25px; margin-right:25px" id="" />
                                    <div>
                                        <p class="bold font-bold fw-bold m-0" for="reference">Set Default Admin Ref</p>
                                        <h6>
                                            In case of set the admin default ref, please check the box.
                                        </h6>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-12 my-4">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </div>
                </form>
            
                <hr>
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                    </div>
                    <div class="col-md-4 p-1">
                        <div class="bg-white p-2 rounded">
            
                            <div>
                                <h5>VIP Package</h5>
                            </div>
                            <hr>
                            @if ($user->vipPurchase?->package)
                                <form action="{{route('admin.vip.destroy', ['id' => $user->vipPurchase?->id])}}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                {{-- <h4 class="alert alert-success">{{ $user->vipPurchase->package->name }}</h4> --}}
                                <div style="max-width: 300px" class="my-3">
                                    {{-- <x-vip-cart :item="$package" :active="$id" /> --}}
                                    <x-vip-cart :item="$user->vipPurchase?->package" :active="$user->vipPurchase?->package?->id" />
                                </div>
                            @else 
                                <div class="alert alert-danger">No Package Found !</div>
                            @endif
            
                        </div>
                    </div>
                </div>
                
                    
            </x-dashboard.section.inner>
        </x-dashboard.section>
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
                        <div>

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
                                <x-text-input type="hidden" name="user" value="{{$user->id}}" />
                               
                                @php
                                    $userPermissions = $user->getPermissionNames();
                                @endphp
                            
                                <x-permissions-to-user :$userPermissions />
                                {{-- @include('components.permissions-to-user') --}}
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
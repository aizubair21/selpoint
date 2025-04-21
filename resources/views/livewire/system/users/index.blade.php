<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.page-header>
        Users
    </x-dashboard.page-header>


    <div>
        <x-dashboard.container>
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        {{-- <x-nav-link href="" :active="true">Any Role</x-nav-link>
                        <x-nav-link href="">Admin Role</x-nav-link>
                        <x-nav-link href="">Vendor Role</x-nav-link>
                        <x-nav-link href="">Reseller Role</x-nav-link>
                        <x-nav-link href="">Rider Role</x-nav-link> --}}
                        
                    </x-slot>
                    <x-slot name="content">
                        <div class="flex justify-between">
                            <div></div>
                            <div class="flex">
                                <x-text-input wire:model.live="search" type="search" placeholder="search" class="py-1"/>
                                {{-- <x-primary-button  class="mx-1">Filter</x-primary-button> --}}
                            </div>
                        </div>
                    </x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    {!!$users->links()!!}

                    <x-dashboard.foreach :data="$users" >
                        <div  x-data="{ users: @js($users) }">
                            <x-dashboard.table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Ref</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>VIP</th>
                                        <th>Order</th>
                                        <th>Wallet</th>
                                        <th>Created</th>
                                        <th>A/C</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{$user->id}} </td>
                                            <td> {{$user->name }} </td>
                                            <td> {{$user->reference ?? "Not Found" }} </td>
                                            <td> 
                                                @php
                                                    $uroles = $user->getRoleNames();
                                                @endphp
                                                <div class="flex">
            
                                                    @foreach ($uroles as $role)
                                                        <div class="px-1 rounded border m-1 text-sm">{{$role}}</div>
                                                    @endforeach
                                                </div>
            
                                            </td>
                                            <td> {{$user->permissions?->count() ?? "Not Found !"}} </td>
                                            <td> {{$user->vipPurchase?->package?->name ?? "No"}} </td>
                                            <td> {{count($user->order?? []) ?? "0"}} </td>
                                            <td> {{$user->coin ?? "0"}} </td>
                                            <td>
                                                {{$user->created_at->toFormattedDateString()}}
                                            </td>
                                            <td>
                                                <div class="flex">
                                                    <x-nav-link href="{{route('system.users.edit', ['id' => $user->id])}}" >                                           
                                                        Edit
                                                    </x-nav-link>
                                                    <x-primary-button>
                                                        edit
                                                    </x-primary-button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </x-dashboard.table>

                        </div>
                    </x-dashboard.foreach>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        </x-dashboard.container>
    </div>
</div>

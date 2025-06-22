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
                        Users
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
                                <x-primary-button  class="mx-1">
                                    <i class="fa-solid fa-filter"></i>
                                </x-primary-button>
                                <x-text-input wire:model.live="search" type="search" placeholder="search" class="py-1"/>
                            </div>
                        </div>
                    </x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    {{$users->links()}}

                    <x-dashboard.foreach :data="$users" >
                        {{-- <div  x-data="{ users: @js($users) }"> --}}
                        <div>
                            <x-dashboard.table >
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
                                            <td> {{$user->id ?? "N/A"}} </td>
                                            <td> 
                                                {{$user->name ?? "N/A" }} 
                                                <br>
                                                <b class="text-xs">{{$user  ->email ?? "N/A" }}</b>
                                            </td>
                                            <td>
                                                {{$user->getRef->ref ?? "N/A"}} 
                                                <br>
                                                <span class="px-2 text-xs rounded border">
                                                    {{$user->reference ?? "Not Found" }} > {{$user->getReffOwner?->owner?->name}}
                                                </span>
                                            </td>
                                            <td> 
                                                @php
                                                    $uroles = $user?->getRoleNames();
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
                                                {{$user->created_at?->toFormattedDateString() ?? ""}}
                                            </td>
                                            <td>
                                                <div class="flex">
                                                    <x-nav-link href="{{route('system.users.edit', ['id' => $user->id])}}" >                                           
                                                        Edit
                                                    </x-nav-link>
                                                    <x-nav-link-btn>VIEW</x-nav-link-btn>
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
    
    
    @script
        <script sec="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
        <script>
            let table = new DataTable('#myTable');
        </script>
    @endscript
</div>
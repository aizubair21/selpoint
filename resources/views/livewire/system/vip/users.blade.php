<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.page-header>
        VIP
        <br>
        <div>
            <x-nav-link :href="route('system.vip.index')" :active="request()->routeIs('system.vip.index')"> <i class="fa-solid fa-up-right-from-square me-2"></i> Package </x-nav-link>
            <x-nav-link :href="route('system.vip.users')" :active="request()->routeis('system.vip.users')"> <i class="fa-solid fa-up-right-from-square me-2"></i> User </x-nav-link>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex flex-wrap justify-between items-start">
                        <div>
                            VIP Users
                        </div>
                        <div class="flex">
                            <x-secondary-button>
                                <i class="fa-solid fa-filter"></i>
                            </x-secondary-button>
                            <input type="search" class="ms-2 rounded-lg border-gray-400 py-1" placeholder="find name, id" wire:model.live="search"  id="">
                        </div>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <x-nav-link href="?nav=Pending" :active="$nav == 'Pending'" >Pending</x-nav-link>
                    <x-nav-link href="?nav=Confirmed" :active="$nav == 'Confirmed'" >Active</x-nav-link>
                    <x-nav-link href="?nav=Trash" :active="$nav == 'Trash'">Trash</x-nav-link>
                </x-slot>
            </x-dashboard.section.header>
    
            <x-dashboard.section.inner>
                <x-dashboard.foreach :data="$vip">

                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>VIP</th>
                                <th>Wallet</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Validity</th>
                                <th></th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach ($vip as $item)     
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> 
                                        {{$item->name ?? "N/A"}} 
                                        <br>
                                        <div class="text-xs ">
                                            {{$item->user?->email ?? "N/A"}}
                                        </div>
                                    </td>
                                    <td> 
                                        {{$item->package?->name ?? "N/A"}} 
                                        <div class="text-xs"> {{$item->task_type ?? "N/A"}} </div>
                                    </td>
                                    <td> {{$item->user?->coin ?? "0"}} </td>
                                   
                                    <td>
                                        @if ($item->status)
                                            Active
                                        @else 
                                            @if($item->stauts == -1 || $item->deleted_at)
                                                Trash
                                            @else 
                                                Pending
                                            @endif
                                        @endif
                                        <br>
                                        @if ($item->deleted_at)
                                            <span class="text-xs text-red-900 text-bold ">
                                                {{$item->deleted_at->toFormattedDateString()}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            {{$item->created_at?->toFormattedDateString()}} </td>
                                        </div> 
                                    <td>

                                    </td>
                                    <td>
                                        <div class="flex space-x-3">
                                            <x-nav-link :href="route('system.vip.edit', ['vip' => $item->id])">View</x-nav-link>
                                            <x-nav-link>User</x-nav-link>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-dashboard.table>

                </x-dashboard.foreach>
            </x-dashboard.section.inner>
        </x-dashboard.section>

    </x-dashboard.container>
</div>

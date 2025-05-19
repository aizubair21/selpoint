<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.page-header>
        VIP
        <br>
        <div>
            <x-nav-link :href="route('system.vip.index')" :active="request()->routeIs('system.vip.index')"> Package </x-nav-link>
            <x-nav-link :href="route('system.vip.users')" :active="request()->routeis('system.vip.users')"> User </x-nav-link>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex justify-between items-start">
                        <div>
                            VIP Users
                        </div>
                        <input type="search" class="rounded-lg border-gray-400 py-1" placeholder="find name, id" wire:model.live="search"  id="">
                    </div>
                </x-slot>
                <x-slot name="content">
                    <x-nav-link href="?nav=Pending" :active="$nav == 'Pending'" >Pending</x-nav-link>
                    <x-nav-link href="?nav=Confirmed" :active="$nav == 'Confirmed'" >Active</x-nav-link>
                    {{-- <x-nav-link href="?nav=Trash" :active="$nav == 'Trash'">Trash</x-nav-link> --}}
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
                                <th>Ref</th>
                                <th>Wallet</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach ($vip as $item)     
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->name ?? "N/A"}} </td>
                                    <td> 
                                        {{$item->package?->name ?? "N/A"}} 
                                        <div class="text-xs"> {{$item->task_type ?? "N/A"}} </div>
                                    </td>
                                    <td></td>
                                    <td> {{$item->user?->coin ?? "0"}} </td>
                                    <td> {{$item->status ? 'Confirmed' : "Pending"}} </td>
                                    <td> {{$item->created_at?->toFormattedDateString()}} </td>
                                    <td>
                                        <div class="flex">
                                            <x-nav-link-btn>edit</x-nav-link-btn>
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

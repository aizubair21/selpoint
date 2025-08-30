<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-dashboard.container>
        <x-dashboard.section>

            <x-dashboard.section.header>
                <x-slot name="title">    
                    <h5>Profile Upgrade (rider)  </h5>
                </x-slot>
        
                <x-slot name="content">
                    <div class="flex justify-between">
                        <div>
                            Upgrade your account to revenew money. To make a new request click bellow button.  
                        </div>
                        
                    </div>
                    <x-nav-link-btn wire:navigate href="{{route('upgrade.rider.create')}}">
                        New Request
                    </x-nav-link-btn>
                </x-slot>
            </x-dashboard.section.header>
            <div>
                <x-nav-link href="{{route('upgrade.vendor.index', ['upgrade' => 'vendor'])}}" > Vendor</x-nav-link>
                <x-nav-link href="{{route('upgrade.vendor.index', ['upgrade' => 'reseller'])}}" > Reseller</x-nav-link>
                <x-nav-link :active="true" href="{{route('upgrade.rider.index')}}" > Rider</x-nav-link>
            </div>
            <x-dashboard.section.inner>
                <x-dashboard.foreach :data="$rider">

                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>A/C</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rider as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->user?->name ?? "N/A"}} </td>
                                    <td> {{$item->status ?? "N/A"}} </td>
                                    <td>
                                        {{ $item->created_at->diffForHumans() }}
                                        <br>
                                        <span class="text-xs">
                                            {{ $item->created_at->toFormattedDateString() }}
                                        </span>
                                    </td>
                                    <td>
                                        <x-nav-link href="{{route('upgrade.rider.edit', $item->id)}}">
                                            Edit
                                        </x-nav-link>
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

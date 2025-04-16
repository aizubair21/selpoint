


<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">    
                <h5>Profile Upgrade ({{$upgrade}})  </h5>
            </x-slot>
    
            <x-slot name="content">
                Upgrade your account to revenew money. To make a new request , click the 
                <a wire:navigate href="{{route('upgrade.vendor.create',)}}">
                    
                    New REQUEST
                    {{-- <x-primary-button>
                    </x-primary-button> --}}
                    
                </a>
                
                
            </x-slot>
        </x-dashboard.section.header>
        <x-hr/>
        <div>
            <x-nav-link :active="$upgrade == 'vendor'" href="?upgrade=vendor" > Vendor</x-nav-link>
            <x-nav-link :active="$upgrade == 'reseller'" href="?upgrade=reseller" > Reseller</x-nav-link>
            <x-nav-link :active="$upgrade == 'rider'" href="?upgrade=rider" > Rider</x-nav-link>
        </div>
        <x-dashboard.section.inner>
            <div  wire:show="upgrade == 'vendor'">
                @if (auth()->user()->requestsToBeVendor->count() > 0)
                    <x-dashboard.section.inner>
                        <x-dashboard.table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach (auth()->user()->requestsToBeVendor()->orderBy('id', 'desc')->get() as $vr)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td>
                                            
                                            <x-nav-link href="{{route('upgrade.vendor.edit', ['id' => $vr->id])}}">
                                                {{$vr->shop_name_bn}}
                                            </x-nav-link>
    
                                        </td>
                                        <td> {{$vr->created_at?->toFormattedDateString()}} </td>
                                        <td> {{$vr->status}} </td>
                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-dashboard.table>
                    </x-dashboard.section.inner>
                @else
                    <div class="alert alert-info">
                        No Previous request found! Make a new request, instead. 
                    </div>
                @endif
            </div>
        </x-dashboard.section.inner>
        <x-dashboard.section.inner>
            <div  wire:show="upgrade == 'reseller'">

                {{-- @if (auth()->user()->requestsToBeReseller->count() > 0)
                    <x-dashboard.section.inner>
                        <x-dashboard.table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach (auth()->user()->requestsToBeVendor()->orderBy('id', 'desc')->get() as $vr)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td>
                                            
                                            <x-nav-link href="{{route('upgrade.vendor.edit', ['id' => $vr->id])}}">
                                                {{$vr->shop_name_bn}}
                                            </x-nav-link>
    
                                        </td>
                                        <td> {{$vr->created_at?->toFormattedDateString()}} </td>
                                        <td> {{$vr->status}} </td>
                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-dashboard.table>
                    </x-dashboard.section.inner>
                @else
                    <div class="alert alert-info">
                        No Previous request found! Make a new request, instead. 
                    </div>
                @endif --}}
            </div>
        </x-dashboard.section.inner>
    </x-dashboard.section>  


</div>

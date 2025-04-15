


<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">    
                <h5>Profile Upgrade (VENDOR)  </h5>
            </x-slot>
    
            <x-slot name="content">
                Upgrade your account to venor to sell your product. To make a new request , click the button below. or check the status of your previous request.
                <div class="md:flex justify-between">
                    <a wire:navigate href="{{route('upgrade.vendor.create')}}">
                        <x-primary-button>
                            New REQUEST
                        </x-primary-button>
                      
                    </a>

                    {{-- <a href="" class="mt-2 md:mt-0 block">
                        <x-secondary-button>
                            previous request
                        </x-secondary-button>
                    </a> --}}
                </div>
            </x-slot>
        </x-dashboard.section.header>
        <x-hr/>
        <x-dashboard.section.inner>
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
        </x-dashboard.section.inner>
    </x-dashboard.section>  


</div>

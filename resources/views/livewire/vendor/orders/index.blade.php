<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-dashboard.page-header>
        Orders
        <br>
        
        @if (auth()->user()->active_nav == 'reseller')     
            <div>
                <x-nav-link href="{{route('vendor.orders.index')}}" :active="request()->routeIs('vendor.orders.*')" > To Me </x-nav-link>
                <x-nav-link href="{{route('reseller.resel-order.index')}}" :active="request()->routeIs('reseller.resel-order.*')" > Resel </x-nav-link>
            </div>

        @endif
        
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Orders
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['belongs_to_type' => $account])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['belongs_to_type' => $account, 'status' => 'Pending'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Cancel
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['belongs_to_type' => $account, 'status' => 'Cancel'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Cancel by User
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['belongs_to_type' => $account, 'status' => 'Cancelled'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Accepted
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['belongs_to_type' => $account, 'status' => 'Accept'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
               
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>


        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Order
                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-between">
                        <div>
                            <x-nav-link href="?nav=Pending" :active="$nav == 'Pending'">Pending</x-nav-link>
                            <x-nav-link href="?nav=Cancel" :active="$nav == 'Cancel'">Cancelled</x-nav-link>
                            <x-nav-link href="?nav=Accept" :active="$nav == 'Accept'">Accepted</x-nav-link>
                            <x-nav-link href="?nav=Cancelled" :active="$nav == 'Cancelled'">Cancel by User</x-nav-link>
                        </div>

                        {{-- <x-nav-link href="?nav=Trash" :active="$nav == 'Trash'">Trash</x-nav-link> --}}

                    </div>
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>

                <x-dashboard.foreach :data="$data">
                    
                    {{$data->links()}}
                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>ID</th>
                                <th>Owner</th>
                                <th>Pd</th>
                                <th>Unit</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Shipping</th>
                                <th>Contact</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> 
                                        <x-nav-link-btn href="{{route('vendor.orders.view', ['order' => $item->id])}}"> view </x-nav-link-btn>    
                                        <x-nav-link href="{{route('vendor.orders.cprint', ['order' => $item->id])}}"> Pint </x-nav-link>    
                                    </td>
                                    <td> {{$item->id ?? "N/A"}} </td>
                                    <td>
                                        <div>
                                            U
                                        </div>
                                    </td>
                                    <td> 
                                        {{$item->cartOrders()->count() ?? "N/A"}} 
                                    </td>
                                    <td>
                                        {{$item->quantity ?? "N/A"}}
                                    </td>
                                    <td>
                                        {{$item->total ?? "N/A"}} <br> <span class="text-xs">+ {{$item->shipping == 'Dhaka' ? 80 : 120}}</span> 
                                    </td>
                                    <td>
                                        {{$item->status ?? "Pending"}}
                                    </td>
                                    <td>
                                        <div class="text-nowarp">
                                            <div>
                                                {{$item->created_at->diffForHumans()}}
                                            </div>
                                            <div class="text-xs">
                                                {{$item->created_at->toFormattedDateString()}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p> {{$item->delevery}} </p> 
                                        <p class="border px-2 rounded bg-gray-900 text-white inline-block bold">{{ $item->area_condition == 'Dkaha' ? 'Dhaka' : 'Other' }}</p>
                                    </td>
                                    <td>
                                        <span class="text-xs">
                                            {{$item->number ?? "N/A"}}
                                        </span>
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

<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

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
        <x-dashboard.section>
            
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Resell Product Order
                </x-slot>
                
                <x-slot name="content">
                    View your resel product, income and comission here
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-dashboard.foreach :$data>

                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>  </th>
                                <th> ID </th>
                                <th> Total </th>
                                <th> Profit </th>
                                <th> Shipping </th>
                                <th> Date </th>
                                <th> Status </th>
                                <th> A/C </th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($data as $item)
                            
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->id}} </td>
                                    <td> {{$item->total ?? 0}} </td>
                                    <td class="font-bold">
                                        {{
                                            $item->resellerProfit()->sum('profit') ?? 0
                                        }}
                                    </td>
                                    <td> {{$item->shipping ?? 0}} </td>
                                    <td> {{$item->created_at?->toFormattedDateString() ?? 0}} </td>
                                    <td> {{$item->status ?? 0}} </td>
                                    <td>
                                        <x-nav-link href="{{route('vendor.orders.view', ['order' => $item->id])}}" >view</x-nav-link>
                                        <x-nav-link href="{{route('vendor.orders.print', ['order' => $item->id])}}">Print</x-nav-link>
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

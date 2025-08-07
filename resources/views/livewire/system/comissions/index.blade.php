<div x-data="{}" x-init="$wire.getData">

    <x-dashboard.page-header>
        <div class="flex justify-between">
            <div>
                Comissions
            </div>

            <x-nav-link-btn href="{{route('system.comissions.takes', ['ord' => true])}}">
                Track
            </x-nav-link-btn>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.overview.section>

            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending
                </x-slot>
                <x-slot name="content">
                    {{$pc}} / {{$pcc}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending Give
                </x-slot>
                <x-slot name="content">
                    {{$pg}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending Store
                </x-slot>
                <x-slot name="content">
                    {{$ps}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Confirmed
                </x-slot>
                <x-slot name="content">
                    {{$cc}} / {{$ccc}}
                </x-slot>
            </x-dashboard.overview.div>

            {{-- <x-dashboard.overview.div>
                <x-slot name="title">
                    Generate
                </x-slot>
                <x-slot name="content">
                    {{$profit}}
                </x-slot>
            </x-dashboard.overview.div> --}}
           
            
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Distributed
                </x-slot>
                <x-slot name="content">
                    {{$give}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Stored
                </x-slot>
                <x-slot name="content">
                    {{$store}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Returned
                </x-slot>
                <x-slot name="content">
                    {{$return}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Seller
                </x-slot>
                <x-slot name="content">
                    {{$seller}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Product
                </x-slot>
                <x-slot name="content">
                    {{$product}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Order
                </x-slot>
                <x-slot name="content">
                    {{$order}}
                </x-slot>
            </x-dashboard.overview.div>
          
        </x-dashboard.overview.section>
        <x-hr/>
        
        <div class="flex justify-between items-center">
            <div>
                Today's Overview
            </div>

            <div class="flex">
                <x-text-input class="bg-transparent py-1" type="date"/>
            </div>
        </div>

        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Generate
                </x-slot>
                <x-slot name="content">
                    {{$tgen ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Take
                </x-slot>
                <x-slot name="content">
                    {{$ttake ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Give
                </x-slot>
                <x-slot name="content">
                    {{$tgive ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Store
                </x-slot>
                <x-slot name="content">
                    {{$tstore ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Return
                </x-slot>
                <x-slot name="content">
                    {{$treturn ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>

        <x-dashboard.section>
            <x-dashboard.table>
                
                <thead>
                    <th>ID</th>
                    <th>Order</th>
                    <th>Product</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th>Profit</th>
                    <th>Rate</th>
                    <th>Take</th>
                    <th>Give</th>
                    <th>Store</th>
                    <th>Return</th>
                    <th>Confirmed</th>
                    <th>
                        A/C
                    </th>
                </thead>

                <tbody>

                    @foreach ($todaysTakeComissions as $item)
                        <tr >
                            <td> {{$item->id ?? "N/A"}} </td>
                            <td> {{$item->order_id ?? 0}} </td>
                            <td> {{$item->product_id ?? 0}} </td>
                            <td> {{$item->buying_price ?? 0}} </td>
                            <td> {{$item->selling_price ?? 0}} </td>
                            <td> {{$item->profit ?? "0"}} </td>
                            <td> {{$item->comission_range ?? "0"}} % </td>
                            <td> {{$item->take_comission ?? "0"}}</td>
                            <td> {{$item->distribute_comission ?? "0"}}</td>
                            <td> {{$item->store ?? "0"}}</td>
                            <td> {{$item->return ?? "0"}}</td>
                            <td>
                                @if ($item->confirmed == true)
                                    <span class="p-1 px-2 rounded-xl bg-green-900 text-white">Confirmed</span>
                                    <x-nav-link href="{{route('system.comissions.take.refund', ['id' => $item->id])}}" > Refund </x-nav-link>
                                @else 
                                    <span class="p-1 px-2 rounded-xl bg-gray-900 text-white">Pending</span>
                                    <x-nav-link href="{{route('system.comissions.take.confirm', ['id' => $item->id])}}" > Confirm </x-nav-link>
                                @endif
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <x-nav-link href="{{route('system.comissions.distributes', ['id' => $item->id])}}">Details</x-nav-link>
                                </div>
                            </td>
                        </tr>    
                    @endforeach
                
                </tbody>
                
            </x-dashboard.table>
        </x-dashboard.section> 

    </x-dashboard.container>

</div>

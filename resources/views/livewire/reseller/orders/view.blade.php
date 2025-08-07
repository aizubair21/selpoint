<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.page-header>
        View Orders 
        <br>
        <div class="text-sm font-normal">
            {{$orders->user_type}} <i class="fas fa-caret-right mx-2"></i> {{ $orders->belongs_to_type}}
        </div>
        
        <div class="text-xs flex items-center sapce-x-2">
            {{$orders->delevery }} Delvevery <i class="fas fa-caret-right px-2"></i> {{$orders->area_condition == 'Dhaka' ? 'Inside Dhaka' : 'Outside of Dhaka'}} 
        </div>
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <div class="flex justify-between items-center space-y-2">
                
                <x-dropdown align="left" maxWidth='sm'>
                    <x-slot name="trigger">
                        <x-primary-button>
                            {{$orders->status}}
                        </x-primary-button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="p-2">
                            <div class="px-2 py-1" wire:click="updateStatus('Pending')">
                                Pending
                            </div>
                            <div class="px-2 py-1" wire:click="updateStatus('Accept')">
                                Accept
                            </div>
                            <div class="px-2 py-1" wire:click="updateStatus('Cancel')">
                                Cancel
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>

            

            </div>
            <div class="flex justify-end items-center space-x-2">
                {{-- <x-nav-link href="{{route('system.comissions.takes', ['query_for' => 'order_id', 'qry' => $orders->id])}}" >COMISSIONS</x-nav-link> --}}
                <x-secondary-button x-show="$wire.$orders->user_type == 'reseller'" x-on:click="$dispatch('open-modal', 'comission-modal')"> comission {{$orders->comissionsInfo?->sum('take_comission') ?? 0}} TK </x-secondary-button>
            </div>
            {{-- <x-nav-link >Print</x-nav-link> --}}
        </x-dashboard.section>
        
        {{-- @if (auth()->user()->active_nav == 'vendor')                
            <x-dashboard.section>
                
            </x-dashboard.section>    
        @endif
         --}}
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Order ID
                </x-slot>
                <x-slot name="content">
                    {{$orders->id}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Products
                </x-slot>
                <x-slot name="content">
                    {{$orders->cartOrders->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Sub Product
                </x-slot>
                <x-slot name="content">
                    {{$orders->cartOrders->sum('quantity') ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Your Profit
                </x-slot>
                <x-slot name="content">
                    @php
                        $buy = $orders->cartOrders->sum('buying_price');
                        $total = $orders->cartOrders->sum('total');
                    @endphp
                    {{ $total - $buy ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            {{-- <x-dashboard.overview.div>
                <x-slot name="title">
                    Comissions
                </x-slot>
                <x-slot name="content">
                    {{ $orders->comissionsInfo->sum('take_comission') ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div> --}}
        </x-dashboard.overview.section>

        <x-dashboard.section>
            <div class="flex justify-between items-start px-5">
                <div class="order-info">
                    
                    <div>Order ID: {{ $orders->id }}</div>
                    <div>Date: <span class="text-xs"> {{ $orders->created_at->toDayDateTimeString() }}</span> </div>
                    
                    <x-nav-link-btn href="{{route('vendor.orders.cprint', ['order' => $orders->id])}}">Print</x-nav-link-btn>
                    {{-- <a target="_blank" href="{{route('admin.order.print')}}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-print pe-2"></i> Print</a>
                    <a target="_blank" href="{{route('admin.order.print', ['id' => $orders->id, 'target' => 'excel'])}}" class="btn btn-sm btn-outline-primary"> <i class="fab fa-excel pe-2"></i> Excel</a> --}}
                    {{-- <table class="table"></table> --}}
                </div>
                <div class="order-total text-end">
                    <table class="table">
                        <tr>
    
                        <p>
                            <strong>{{ $orders->user?->name ?? "Not Found !" }} <br> </strong> {{$orders->location}}
                            <br>
                            {{ $orders->house_no ?? 'Not Defined !' }},</> {{$orders->road_no ?? "Not Defined !"}}
                            <br>
                            {{$orders->number}}
    
                        
                        </p>
                        </tr>
                        <tr>
                            {{-- <th>House</th>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <th>Road</th>
                            <td>
                            </td>
                        </tr> --}}
                    </table>
                </div>
            </div>
            
            <x-dashboard.table>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Owner</th>
                        <th>Resel Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Attr</th>
                        <th>Net Price</th>
                        <th>Profit</th>
                        <th>Comissions</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($orders->cartOrders as $item)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->id ?? "N/A"}} </td>
                            <td> 
                                <div class=" ">
                                    <img width="30px" height="30px" src="{{asset('storage/' . $item->product?->thumbnail)}}" alt="">
                                    <div>
                                        {{$item->product?->title ?? "N/A"}} 
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($item->product?->isResel)
                                    <span class="bg-indigo-900 text-md text-white rounded-lg px-2"> Resel </span>
                                @else 
                                    <span class="bg-indigo-900 text-md text-white rounded-lg px-2"> You </span>
                                @endif
                            </td>
                            <td>
                                {{$item->price}} TK
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                {{$item->total}} TK
                            </td>
                            <td>
                                {{$item->size ?? "N/A"}}
                            </td>
                            <td>
                                {{$item->buying_price ?? "N/A"}} TK
                            </td>
                           
                            <td>
                                {{ ($item->price - $item->buying_price) * $item->quantity }}
                            </td>
                            <th>
                                {{$item->order->comissionsInfo?->sum('take_comission')}}
                            </th>
                        </tr>
                    @endforeach
                <tbody>
            
                <tfoot>
                    <tr class="border-t">
                        <td colspan="6" class="text-right">Sub Total</td>
                        <td>
                            {{ $orders->cartOrders->sum('total')}} Tk
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Shipping</td>
                        <td>
                            {{ $orders->shipping ?? 0}} Tk
                        </td>
                    </tr>
                    <tr class="border-t font-bold text-lg bg-gray-100">
                        <td colspan="6" class="text-right">Total</td>
                        <td>
                            {{ $orders->shipping + $orders->cartOrders->sum('total')}} Tk
                        </td>
                        <td colspan="6"></td>
                    </tr>
                </tfoot>
            
            </x-dashboard.table>

            

        </x-dashboard.section>


        <x-modal name="comission-modal" >
            <div class="p-2">
                COMISSIONS
                <x-hr/>

                <x-dashboard.table :data="$orders->comissionsInfo" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->comissionsInfo as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->take_comission ?? 0}} </td>
                                <td> {{$item->product?->name ?? "N/A"}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </div>
        </x-modal>

    </x-dashboard.container>
</div>

<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.page-header>
        View Orders
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <div class="flex justify-between">
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
               {{-- <x-nav-link >Print</x-nav-link> --}}
            </div>
        </x-dashboard.section>
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
                            {{$orders->number_1}}
    
                        </p>
                        <div>
                            Today : {{now()->toDayDateTimeString()}}
                        </div>
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
        </x-dashboard.section>


        <x-dashboard.section>
          
            <x-dashboard.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Attr</th>
                        <th>Buy</th>
                    </tr>
                </thead>
                    @foreach ($orders->cartOrders as $item)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->id ?? "N/A"}} </td>
                            <td> 
                                <div class="flex items-start">
                                    <img width="30px" height="30px" src="{{asset('storage/' . $item->product?->thumbnail)}}" alt="">
                                    <div>
                                        {{$item->product?->title ?? "N/A"}} 
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$item->price}}
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                {{$item->total}}
                            </td>
                            <td>
                                {{$item->size ?? "N/A"}}
                            </td>
                            <td>
                                {{$item->product?->buying_price ?? "N/A"}}
                            </td>
                        </tr>
                    @endforeach
                <tbody>

                </tbody>
            </x-dashboard.table>

        </x-dashboard.section>

    </x-dashboard.container>
</div>

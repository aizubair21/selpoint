<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Order Details
                </x-slot>

                <x-slot name="content">
                    {{$orders->created_at->toFormattedDateString()}} at {{$orders->created_at?->format('H:i a')}}
                    <div>
                        Order Id : {{$orders->id}}
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <x-dashboard.section>
            {{-- <x-dashboard.foreach :data="$orders->toArray()"> --}}
                <x-dashboard.table>

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Attr</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($orders->cartOrders)
                        @endif --}}
                            @foreach ($orders->cartOrders as $key => $order)
                                <tr>
                                    <td>{{ $loop->iteration ++ }}</td>
                             
                                    <td>
                                        {{-- {{ $order->product?->name ?? "Not Found !" }} --}}
                                        <x-nav-link class="text-xs" href="{{route('products.details', ['id' => $order->product?->id ?? '',  'slug' => $order->product?->slug ?? ''])}}" >
                                            <img width="30px" height="30px" src="{{asset('storage/'. $order->product?->thumbnail)}}" alt="">
                                            {{$order->product?->name ?? "N/A" }}
                                        </x-nav-link>
                                    </td>
                                    <td> {{$order->quantity}} </td>
                                    <td> {{$order->size}} </td>
                                    <td> {{ $order->price}} </td>
                                    <td> {{ $order->total}} </td>
                                    {{-- <td> {{$order->product?->buying_price ?? "0" }} </td> --}}
                                </tr>
                                {{-- @php
                                    $buyingPrice += $order->product?->buying_price ?? '0';
                                    // $comission += $order->product?->comissions->sum('comission');
                                @endphp --}}
                            @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100">
                            <td colspan="5" class="text-right">Total</td>
                            <td colspan="2" class=""> {{$orders->total ?? "0"}} TK </td>
                        </tr>
                      
                        <tr>
                            <td colspan="5" class="text-right">Shipping</td>
                            <td colspan="2" class="">{{$orders->shipping ?? "120"}} Tk </td>
                        </tr>
                     
                        <tr class="bg-gray-200">
                            <td colspan="5" class="text-right">Payable</td>
                            <td colspan="2" class="">{{$orders->shipping + $order->total}}  TK </td>
                        </tr>
                      
                    </tfoot>
                </x-dashboard.table>
        </x-dashboard.section>

        <div x-data="{'shipping' : false}" class="max-w-md">
            <x-dashboard.section>
                    
                    <div class="flex justify-between items-center" @click="shipping = !shipping">
                        <div>
                            Shipping
                        </div>
                        <div>
                            <div class="px-2 py-1 bg-indigo-900 text-white rounded-lg">
                                {{$orders->shipping ?? "0"}} TK
                            </div>
                        </div>
                    </div>

                    <div class="py-2">

                        <div class="text-xs flex items-center sapce-x-2">
                            {{$orders->delevery }} Delevery {{$orders->area_condition == 'Dhaka' ? 'in Dhaka' : 'Outside of Dhaka'}} 
                        </div>
                    </div>
                    <x-hr/>

                    <div class="pt-2 mb-10">
                        {{$orders->location ?? "N/A"}}
                        <br>
                        {{$orders->number ?? "N/A"}}
                    </div>
           
            </x-dashboard.section>
        </div>

    </x-dashboard.container>



</div>

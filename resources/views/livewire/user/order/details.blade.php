<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Order Details
                </x-slot>

                <x-slot name="content">
                    {{$orders->created_at->diffForHumans()}}
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
                            <th>ID</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($orders->cartOrders)
                        @endif --}}
                            @foreach ($orders->cartOrders as $key => $order)
                                <tr>
                                    <td>{{ $loop->iteration ++ }}</td>
                                    <td>{{ $order->product_id }}</td>
                                    <td>
                                        <img src="{{asset('storage/'.$order->product?->thumbnail)}}" style="width:50px; height:50ps" alt="">
                                    </td>
                                    <td>{{ $order->product?->name ?? "Not Found !" }}</td>
                                    <td> {{$order->quantity}} </td>
                                    <td> {{$order->size}} </td>
                                    <td> {{ $order->price * $order->quantity }} </td>
                                    {{-- <td> {{$order->product?->buying_price ?? "0" }} </td> --}}
                                </tr>
                                {{-- @php
                                    $buyingPrice += $order->product?->buying_price ?? '0';
                                    // $comission += $order->product?->comissions->sum('comission');
                                @endphp --}}
                            @endforeach
                    </tbody>
                </x-dashboard.table>
        </x-dashboard.section>
    </x-dashboard.container>
</div>

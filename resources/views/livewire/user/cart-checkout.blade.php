<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Checkout
                </x-slot>
                <x-slot name="content">
                    view and order your cart produtct.
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>


        {{-- <x-dashboard.section>
            <x-dashboard.foreach :data="auth()->user()->myCarts">
                <x-dashboard.table>
                    <thead>
                        <th></th>
                        <th>product</th>
                        <th>quantity</th>
                        <th>price</th>
                    </thead>
    
                    <tbody>
                        @foreach (auth()->user()->myCarts as $cart)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <div class="flex">
                                        <img width="30px" height="30px" src="{{asset('storage/' . $cart->thumbnail)}}" alt="">
                                        {{$cart->product?->name ?? "N/A"}}
                                    </div>
                                </td>
                                <td>
                                    {{$cart->quantity ?? "0"}}
                                </td>
                                <td> {{$cart->total ?? "0"}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.foreach>
        </x-dashboard.section> --}}


        <x-hr/>

        <x-dashboard.foreach :data="$carts" >
            <x-dashboard.table>
                <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($carts as $cart)
                        @php
                            $totalAmount =+ $cart->product?->price;
                        @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            
                            <td class="text-sm">
                                <x-nav-link href="{{route('products.details', ['id' => $cart->product?->id ?? '',  'slug' => $cart->product?->slug ?? ''])}}" >
                                    <img width="30px" height="30px" src="{{asset('storage/'. $cart->product?->thumbnail)}}" alt="">
                                    {{$cart->product?->title ?? "N/A" }}
                                </x-nav-link>
                            </td>
                            <td>
                                <x-text-input style="width:75px" type="number" wire:model="qty.$cart->id" />
                            </td>
                            <td>{{$cart->product?->price ? $cart->product?->price * $cart->qty : "N/A" }}</td>
                           
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            Total
                        </td>
                        <td></td>
                        <td></td>
                        <td class="bold" >
                            <strong> {{$totalAmount}} TK</strong>
                        </td>
                    </tr>
                </tbody>

            </x-dashboard.table>
        </x-dashboard.foreach>
    </x-dashboard.container>


    
    <x-dashboard.container>
        <x-dashboard.section>
            @includeIf('components.client.order-details')
        </x-dashboard.section>
    </x-dashboard.container>
</div>

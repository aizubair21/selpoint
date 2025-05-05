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

        <pre>
            @php
                // print_r(auth()->user()->myCarts()->groupBy('belongs_to')->toArray() );
            @endphp
        </pre>

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


        <x-dashboard.section>
            <x-dashboard.foreach :data="$carts" >
                <x-dashboard.table>
                    <thead>
                        <th></th>
                        <th></th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </thead>
    
                    <tbody>
                        @php
                            $tprice = 0;
                        @endphp
                        @foreach ($carts as $key => $cart)
                            @php
                                $sprice = $cart['price'] * $cart['qty'];
                                $tprice =+ $sprice;
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                
                                <td class="text-sm">
                                    <x-nav-link href="{{route('products.details', ['id' => $cart['product_id'] ?? '',  'slug' => Str::slug($cart['name']) ?? ''])}}" >
                                        <img width="30px" height="30px" src="{{asset('storage/'. $cart['image'])}}" alt="">
                                        {{$cart['name'] ?? "N/A" }}
                                    </x-nav-link>
                                </td>
                                <td>
                                    <div class="flex justify-between px-1 py-0 border rounded" style="width: 120px">
                                        <button class="p-1 text-lg" wire:click="decreaseQuantity({{$cart['id']}})" >-</-button>
                                        <input style="width:50px" class="border-0 py-0 text-center w-sm rounded" min="1" type="text" @disabled(true) value="{{$cart['qty']}}"  />
                                        <button class="p-1 text-lg" wire:click="increaseQuantity({{$cart['id']}})" >+</button>
                                    </div>
                                </td>
                                <td>
                                    {{$cart['price']}} x {{$cart['qty']}} = {{ $sprice ?? "N/A" }}
                                </td>
                               
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                Total
                            </td>
                            <td>
                            </td>
                            <td>
                                {{$q}}
                            </td>
                            <td class="bold" >
                                <strong> {{$tp ?? "0"}} TK</strong>
                            </td>
                        </tr>
                    </tbody>
    
                </x-dashboard.table>
            </x-dashboard.foreach>
        </x-dashboard.section>
    </x-dashboard.container>


    
    <x-dashboard.container>
        <x-dashboard.section>
            @includeIf('components.client.order-details')
        </x-dashboard.section>
    </x-dashboard.container>
</div>

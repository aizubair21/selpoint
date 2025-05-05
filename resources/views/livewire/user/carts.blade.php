<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    
    <x-dashboard.container>
        <x-dashboard.section @class(['hidden' => request()->routeIs('user.carts.checkout')])>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Carts
                </x-slot>
                
                <x-slot name="content">
                    view, remove your cart item from previous.
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{auth()->user()->myCarts()->count() ?? "0"}} items in cart
                </x-slot>
                <x-slot name="content">
                    <x-nav-link @class(['hidden' => request()->routeIs('user.carts.checkout')]) href="{{route('user.carts.checkout')}}">
                        <x-primary-button>
                            checkout
                        </x-primary-button>
                    </x-nav-link>
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-dashboard.foreach :data="auth()->user()->myCarts" >
                    <x-dashboard.table>
                        <thead>
                            <th></th>
                            <th></th>
                            <th>product</th>
                            <th>price</th>
                            <th>date</th>
                            <th>A/C</th>
                        </thead>

                        <tbody>
                            @foreach (auth()->user()->myCarts as $cart)
                                @php
                                    $totalAmount =+ $cart->product?->price;
                                @endphp
                                <tr>
                                    <td></td>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td class="text-sm">
                                        <x-nav-link href="{{route('products.details', ['id' => $cart->product?->id ?? '',  'slug' => $cart->product?->slug ?? ''])}}" >
                                            <img width="30px" height="30px" src="{{asset('storage/'. $cart->product?->thumbnail)}}" alt="">
                                            {{$cart->product?->title ?? "N/A" }}
                                        </x-nav-link>
                                    </td>
                                    <td>{{$cart->product?->price ?? "N/A" }}</td>
                                    <td>{{$cart->created_at->diffForHumans() ?? "N/A" }}</td>
                                    <td>
                                        <x-danger-button wire:click="remove({{$cart->id}})">remove</x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td></td>
                                <td></td>
                                <td class="bold" >
                                    <strong> {{$totalAmount ?? "0"}} TK</strong>
                                </td>
                            </tr>
                        </tbody>

                    </x-dashboard.table>
                </x-dashboard.foreach>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>

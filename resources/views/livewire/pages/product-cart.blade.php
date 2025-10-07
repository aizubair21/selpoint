<div class="box border bg-white">


    @if($product->offer_type && $product->discount)
    @php
    $originalPrice = $product->price;
    $discountedPrice = $product->discount;
    $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
    @endphp
    <div class="discount-badge bg_primary" style="">{{ round($discountPercentage, 0) }}%</div>
    @endif

    <div class="option_container hidden lg:block"
        style="background-color:hsla(24, 100%, 90%, 0.419);; transform:blur(10px)">
        <div class="flex flex-col justify-between items-center" style="height:100%; width:100%">

            <div class="flex flex-col justify-center w-full text-center flex-1">

                <div class="">
                    <button wire:click="addToCart" class=" p-2 text-sm mb-4 bg-white text-center w-full" type="submit">
                        <i class="fas fa-cart-plus mx-2"></i> To Cart
                    </button>
                </div>

                <a wire:navigate href="{{route('products.details', ['id' => $product->id, 'slug' => $product->slug])}}"
                    class="text-xs">
                    View Details <i class="fas fa-arrow-right mx-2"></i>
                </a>
            </div>
            <x-nav-link class="py-2 text-center bg-white flex items-center justify-center"
                style="font-weight:bold;color:var(--brand-primary); width:100%"
                href="{{route('product.makeOrder', ['id' => $product->id, 'slug' => $product->slug])}}">
                Order Now <i class="fas fa-arrow-right mx-2"></i>
            </x-nav-link>
        </div>
    </div>

    <div class="img-box">
        <img src="{{ asset('storage/' . $product->thumbnail) }}">
    </div>

    {{-- card body --}}
    <div class=" p-2 flex flex-col justify-between">

        <div class="text-white">

            {{-- <a href="{{ route('product.details', ['id' => $product->id]) }}"
                class="d-block w-100 mr-1 px-3 py-1 bold d-block bg_primary border-0 text-start text-light"
                style="border-top-right-radius:12px; border-bottom-right-radius:12px">
                {{ $product->name }}
            </a>

            <div style="width:20%; border-top-left-radius:12px; border-bottom-left-radius:12px"
                class="px-2 h-100 bg_primary d-flex justify-content-center align-items-center text-light">
                {{ $product->unit }}
            </div> --}}


            <a wire:navigate href="{{route('products.details', ['id' => $product->id, 'slug' => $product->slug])}}"
                class="text-black">
                {{ Str::limit($product->title ?? 'Product Title Here', 17, '...')}}
            </a>

            {{-- <div style="width:20%;" class="text-sm py-1 px-2 bg_primary">
                {{ $product->unit ?? "0"}}
            </div> --}}

        </div>

        <div style="height:32px; width:100%; display:flex; flex-direction:colums-reverse; align-items: center; font-size:14px; justify-content:space-between"
            class=" py-1">
            @if($product->offer_type)

            <div class="text-md @if($product->offer_type ) @else align-self:center @endif"
                style="font-weight: bold; text-align:right">
                {{$product->discount}} TK
            </div>

            <div class="text-xs">
                <del>
                    MRP {{$product->price}} TK
                </del>
            </div>

            @else
            <div class=" test-md @if($product->offer_type ) pr-2 @else align-self:center @endif"
                style="font-weight: bold; text-align:right">
                {{$product->price}} TK
            </div>
            @endif
        </div>
        {{-- <div style="font-size: 13px;background-color:var(--brand-light);"
            class=" px-3 py-1 rounded-pill  d-flex justify-content-center align-items-center">
            <div style="width:10px; height:10px; border-radius:50%; background-color:var(--brand-primary); "
                class="mr-2"></div>
            {{ $product->unit }}
        </div> --}}

        {{-- @guest
        <a type="button"
            class=" btn_hover hover_zoom d-block py-2 text-center d-flex align-items-center justify-content-center option1"
            style="font-weight:bold; color:var(--brand-primary); width:100%"
            href="{{ route('order.single', ['id' => $product->id]) }}">
            Order Now <i class="fas fa-arrow-right mx-2"></i>

        </a>

        <form action="{{ route('cart.add', $product->id) }}" method="post" class="">
            @csrf
            <button class="border-0 p-2 fs-4 bg-none text-center w-100 text-light" type="submit"
                style="background-color: var(--brand-primary)">
                <i class="fas fa-cart-plus mx-2"></i> To Cart
            </button>


        </form>

        @else
        @endguest --}}
        <a type="button"
            class="bg-white text-sm btn_hover hover_zoom d-block text-center flex items-center justify-center"
            style="font-weight:bold; color:var(--brand-primary); width:100%"
            href="{{route('product.makeOrder', ['id' => $product->id, 'slug' => $product->slug])}}">
            </i>Order Now
        </a>
        {{-- <form action="{{ route('cart.add', $product->id) }}" method="post" class="">
            @csrf
            <button class="border-0 p-2 bg-white text-center w-100 text_secondary" type="submit">
                <i class="fas fa-cart-plus mx-2"></i> To Cart
            </button>


        </form> --}}


    </div>

</div>
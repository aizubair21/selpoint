<div>
    <x-dashboard.container>

        <div class="flex justify-start items-center py-3 mb-3">
            <i class="fas fa-home pe-2"></i>
            {{-- <i class="fas fa-slash-back px-2 py-0 m-0"></i> --}}
            <div>
                search
            </div>
            {{-- <i class="fas fa-caret-right px-2 py-0 m-0"></i> --}}
            <div class="px-2">
                {{$q}}
            </div>
        </div>
        @if ($product->count() > 0)
        <div class="product_section">
            <div class=""
                style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); grid-gap:10px">
                @foreach ($product as $prod)
                <x-client.product-cart :product="$prod" :key="$prod->id" />
                @endforeach
            </div>
        </div>
        {{ $product->links() }}
        @else
        <p>No products found.</p>
        @endif
    </x-dashboard.container>
    <x-hr />
    <x-dashboard.container>
        @if ($shop->count() > 0)
        <div
            style="display: grid; grid-template-columns:repeat(auto-fit, 300px); justify-content:start; align-items:start; grid-gap:10px">

            @foreach ($shop as $sh)
            <x-client.shops-cart :shop="$sh" :key="$sh->id" />
            @endforeach

        </div>
        <x-hr />
        @endif
    </x-dashboard.container>
    {{--
    <x-hr /> --}}
    <x-dashboard.container>

        @if (count($category) > 0)
        <div>
            Categories
        </div>
        <div wire:loading.disabled class=""
            style="display: grid; grid-template-columns:repeat(auto-fit, 100px); grid-gap:10px">
            {{-- @foreach ($category as $cat)
            <x-nav-link class="px-2 rounded border" href="{{ route('category.products', ['cat' => $cat->slug]) }}">{{
                $cat->name }}</x-nav-link>
            @endforeach --}}

            @foreach ($category as $item)
            @if ($item->slug != 'default-category')
            <div class="relative text-center rounded " style="backdrop-filter:blur(3px); background-color:#fff">
                <a href="{{ route('category.products', ['cat' => $item->slug]) }}" style="height: 100px;" wire:navigate>
                    <img src="{{asset('storage/'.$item->image)}}" class="w-full h-full" alt="">
                    <div class="absolute bottom-0 shadow text-white w-full text-center font-bold" style="background-color:
                                rgba(0, 0, 0, 0.173); backdrop-filter:blur(6px)">
                        {{ Str::limit($item->name, 10, '...') }}
                    </div>
                </a>
            </div>
            @endif
            @endforeach
        </div>
        @endif
        {{-- @else
        <p class="mb-2">All You Need </p>
        <div class="flex gap-3">

            @foreach ($category as $item)
            @if ($item->slug != 'default-category')
            <div class="relative bg-white text-center rounded hover:border-indigo-900 hover:shadow w-full"
                style="width:110px">
                <a href="{{ route('category.products', ['cat' => $item->slug]) }}" style="height: 100px;" wire:navigate>
                    <img src="{{asset('storage/'.$item->image)}}" class="w-full h-full" alt="">
                    <div class="absolute bottom-0 shadow text-white px-1 w-full text-center" style="background-color:
                                    #00000067; backdrop-filter:blur(6px)">
                        {{$item->name}}
                    </div>
                </a>
            </div>
            @endif
            @endforeach

        </div> --}}
    </x-dashboard.container>
</div>
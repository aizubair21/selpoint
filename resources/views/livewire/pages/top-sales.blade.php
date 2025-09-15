<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="py-4 flex px-2 justify-between items-center">
        <div class="text-xl font-bold">
            Top Sales
        </div>

    </div>
    <div class="product_section pt-4" x-loading.disabled x-transition>
        {{-- @includeIf('components.client.common-heading') --}}
        {{--
        <x-client.products-loop :$products /> --}}
        @if (count($topSales))
        <div class=""
            style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); grid-gap:10px">
            @foreach($topSales as $product)
            <x-client.product-cart :$product :key="$product->id" />
            @endforeach
        </div>
        @endif

    </div>
</div>
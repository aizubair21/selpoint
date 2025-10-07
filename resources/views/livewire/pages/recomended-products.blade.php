<div>
    {{-- Stop trying to control. --}}
    <div x-init="$wire.get">
        <div class="py-4 flex px-2 justify-between items-center">
            <div class="text-xl font-bold">
                For You
            </div>

        </div>
        <div class="product_section pt-4" x-loading.disabled x-transition>
            {{-- @includeIf('components.client.common-heading') --}}
            {{--
            <x-client.products-loop :$products /> --}}
            @if (($data))
            <div class=""
                style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); grid-gap:10px">
                @foreach($data as $product)
                @livewire('pages.product-cart', ['product' => $product], key($product->id))
                @endforeach
            </div>
            @endif

        </div>
    </div>
</div>
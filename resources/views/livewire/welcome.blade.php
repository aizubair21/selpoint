<div>
    
    {{-- Be like water. --}}
    <x-dashboard.container>
        <div class="product_section layout_padding">
            @includeIf('components.client.common-heading')
            {{-- <x-client.products-loop :$products /> --}}
            @if (count($products))     
                <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(170px, auto)); grid-gap:10px">
                    @foreach($products as $product)
                        <x-client.product-cart :$product :key="$product->id" />
                    @endforeach    
                </div>
            @endif
    
        </div>
    
        <div class="text-center">
            <x-nav-link href="{{route('products.index')}}" class="px-3 py-2 rounded btn_outline_secondary">
                View All products
            </x-nav-link>
        </div>
    </x-dashboard.container>


</div>

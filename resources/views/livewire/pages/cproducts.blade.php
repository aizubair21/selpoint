<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-dashboard.container>
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Eruhi <span>Marketplace</span>
                </h2>
            </div>

            <div class="product_section layout_padding">

                {{-- <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); grid-gap:10px">
                    @foreach($products as $product)
                       <x-client.product-cart :$product :key="$product->id"/>
                    @endforeach    
                </div> --}}
                
                <x-client.products-loop :$products />
            </div>
    
            @if (!$products || count($products) == 0)
                <div class="alert alert-info">No Product Found !</div>
            @endif
        </div>
    </x-dashboard.container>
</div>

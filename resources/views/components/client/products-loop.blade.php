<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->

    @props(['products'])
    {{-- <div class="row p-0 m-0 mb-2 justify-content-start align-items-start">
        @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 p-1 mb-3">
                <x-client.product-cart :$product :key="$product->id" />
            </div>
        @endforeach
    </div> --}}

    <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(170px, auto)); grid-gap:10px">
        @foreach($products as $product)
            <div class="">
            <x-client.product-cart :$product :key="$product->id" />
            </div>
        @endforeach    
    </div>
    
    {{-- <x-product-card product="{{$products}}" :key="$product->id" /> --}}

    <div class="mt-4">
        {{ $products->links() }}
    </div>
    
</div>
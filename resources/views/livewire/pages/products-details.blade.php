<div>
    {{-- The Master doesn't talk, he acts. --}}

    <x-dashboard.container>
        <x-dashboard.section>
            @includeIf('components.client.product-single')
        </x-dashboard.section>


        <div class="lg:flex justify-between items-start m-0">
            <div class="lg:w-[80%] py-3">
                <x-dashboard.section>
                    <div class="bg-white p-2 w-full">
                        {!! $product->description ?? "No Description Found !" !!}
                    </div>
                    <x-hr/>
                    <div class="bg-white p-2 w-full">
                        <div class="text-xs">
                            Review Not Available
                        </div>
                    </div>
                </x-dashboard.section>

            </div>

            <div class="py-3 lg:w-[20%] product_section">
              
                <h4>You May Also Like</h4>
                <div class="row p-0 m-0 mb-2">
                    @foreach($relatedProduct as $product)
                        <div class="col-6 p-1 mb-3">
                            <x-client.product-cart :$product :key="$product->id" />
                        </div>
                    @endforeach
                </div>
            
                {{-- <x-product-card :$product :key="$product->id" /> --}}

            </div>
        </div>
    </x-dashboard.container>
</div>

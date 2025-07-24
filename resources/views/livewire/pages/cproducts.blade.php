<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @livewire('pages.slider')
    <x-dashboard.container>
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Eruhi <span>Marketplace</span>
                </h2>
            </div>

            <div class="flex justify-start items-center py-3 border-y mb-3">
                <i class="fas fa-home pe-2"></i>
                {{-- <i class="fas fa-slash-back px-2 py-0 m-0"></i> --}}
                <div>
                    Category
                </div>
                {{-- <i class="fas fa-caret-right px-2 py-0 m-0"></i> --}}
                <div>

                </div>
            </div>

            <div class="product_section ">

                {{-- <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); grid-gap:10px">
                    @foreach($products as $product)
                       <x-client.product-cart :$product :key="$product->id"/>
                    @endforeach    
                </div> --}}

                <div class="md:flex w-full">
                    <div style="width: 300px" class="px-3 hidden md:block">
                        {{-- @livewire('reseller.resel.categories') --}}
                        @foreach ($categories as $item)
                            {{-- <x-client.cat :cat="$cat" :active="($cat->name == $this->cat)" /> --}}
                            <x-client.cat-loop :item="$item" :key="$item->id"  />
                        @endforeach
                    </div>
                    
                    <div class="flex block md:hidden px-3 mb-2 overflow-x-scroll" style="height:100px">
                        {{-- @foreach ($categories as $product)
                            <div class="" style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 130px); grid-gap:10px">
                                <x-client.cat :cat="$product" :height="80" :key="$product->id" />
                            </div>
                        @endforeach --}}
                    </div>



                    <div class="md:px-5 w-full">
                        {{-- <x-client.products-loop :$products /> --}}
                        <div class="w-full" style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px">
                            @foreach ($products as $product)
                                <x-client.product-cart :$product :key="$product->id" />
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
    
            @if (!$products || count($products) == 0)
                <div class="alert alert-info">No Product Found !</div>
            @endif
        </div>
    </x-dashboard.container>
</div>

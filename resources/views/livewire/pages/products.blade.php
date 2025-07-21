<div class="py-4" x-init="$wire.getData">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    
    
    <div class="">
        @includeIf('components.client.common-heading')
    </div>
    <x-dashboard.container>

        <div class="flex justify-start items-start">
            {{-- <div style="width:200px" class=" mr-3">

                filter 
                <div class="text-xs text-gray-900">filter</div>
                <div>
                    <div class="py-1 flex items-center justify-start">
                        <input type="checkbox" name="" style="width:20px; height:20px" id="">
                        <div class="ps-3"> Include Discount </div>
                    </div>
                    <div class="py-1 flex items-center justify-start">
                        <input type="checkbox" name="" style="width:20px; height:20px" id="">
                        <div class="ps-3"> Without Discount </div>
                    </div>
                </div>

            </div> --}}
            
            <div class="w-full">
                
                <div class="flex flex-wrap justify-between items-center mb-3">
                    
                    <div>
                        <x-text-input type="search" placeholder="Search ...." class="py-1" />
                    </div>
                    <div class="flex items-center justify-between space-x-2">
                        <x-secondary-button >
                            <i class="fas fa-filter"></i>
                        </x-secondary-button>
                        <select wire:model.live="sort" id="sort_by" class="w-24 rounded py-1">
                            <option value="desc">Newest</option>
                            <option value="asc">Oldest</option>
                        </select>
                    </div>
                </div>
        
                <div class="product_section" x-loading.disabled x-transition>
                    {{-- <x-client.products-loop :$products /> --}}
                    @if (count($products))     
                        <div class="" style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px">
                          
                            @foreach ($products as $product)
                                <x-client.product-cart :$product :key="$product->id" />
                            @endforeach
                                      
                        </div>
                    @endif
        
                    <div class="text-center" wire:show="load">
                        <button wire:click.prevent="loadMore" class="px-3 py-1 rounded border mt-3">Load More</button>
                    </div>
                </div>

            </div>
        </div>


    </x-dashboard.container>

    {{-- <div class="text-center">
        <a href="{{route('uproducts.index')}}" class="px-3 py-2 rounded btn_outline_secondary">
            View All products
        </a>
    </div> --}}
    

    <script>
        let ps = document.getElementsByClassName('product_section')[0];
        let html = 
        `
        <div class="p-3 rounded shadow m-1">
            new item
        </div>
        `;
        document.addEventListener('scroll', (e)=>{
            let documentHeight = document.body.clientHeight;
            let scrollToTop = document.documentElement.scrollTop;
            let windowHeight = window.innerHeight;
            
            console.log(documentHeight, scrollToTop, documentHeight - scrollToTop);
            
            // ps.insertAdjacentHTML('beforeend', html)

            // if(documentHeight, scrollToTop){

            // }
            
        });
    </script>
</div>

<div class="py-4" x-init="$wire.getData">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    
    

    <x-dashboard.container>

        @includeIf('components.client.common-heading')
        <div class="product_section">
            {{-- <x-client.products-loop :$products /> --}}
            @if (count($products))     
                <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(160px, auto)); grid-gap:10px">
                    @foreach($products as $product)
                        <x-client.product-cart :$product :key="$product->id" />
                    @endforeach    
                  
                </div>
            @endif

            <div class="text-center" wire:show="load">
                <button wire:click.prevent="loadMore" class="px-3 py-1 rounded border mt-3">Load More</button>
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

<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.container>
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>Categories</span>
                </h2>
            </div>
            
            {{-- <div class="row"> --}}
            <div style="display: grid; grid-template-columns:repeat(auto-fill, minmax(149px, 1fr));grid-gap: 10px;">
                @foreach($categories as $product)
                    <x-client.cat :cat="$product" :key="$product->id" />
                @endforeach    
            </div>
        </div>
    </x-dashboard.container>
</div>

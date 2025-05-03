<div class="py-4">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    
    <div class="product_section layout_padding">
        @includeIf('components.client.common-heading')
        <x-client.products-loop :$products />
    </div>

    <div class="text-center">
        <a href="{{route('uproducts.index')}}" class="px-3 py-2 rounded btn_outline_secondary">
            View All products
        </a>
    </div>
    
</div>

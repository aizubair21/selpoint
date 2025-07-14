<div>
    {{-- The whole world belongs to you. --}}

    <x-dashboard.page-header>
        Resel Products
        <br>    
        <div>
            {{-- <x-nav-link href="{{route('vendor.products.view')}}" :active="request()->routeIs('vendor.products.*')" >Your Product</x-nav-link> --}}
            <x-nav-link href="{{route('reseller.resel-product.index')}}" :active="request()->routeIs('reseller.resel-product.*')" > Product</x-nav-link>
            <x-nav-link href="{{route('reseller.resel-products.catgory')}}" :active="request()->routeIs('reseller.resel-products.*')" > Category</x-nav-link>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>
        {{-- <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="text-md">Product for Resel</div>
                </x-slot>

                <x-slot name="content">
                    If you plan to resel produt, you are requested to copy product data form here then add to your won product.
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                
                
                <div wire:show="!cat">
                    <div class="flex items-center">
                        <x-text-input type="search" class="py-1 mx:w-48" placeholder="Search By Name .."></x-text-input>
                    </div>
                </div>
            </x-dashboard.section.inner>
            
            <x-dashboard.section.header>
                <x-slot name="title">
                    
                </x-slot>
                <x-slot name="content"></x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section> --}}
        {{-- <div wire:show="cat">
            Display from <span class="px-2 border rounded mx-1 font-bold"> {{$targetCat->name ?? "n/a"}}  </span> category.
            <x-primary-button wire:show="cat" wire:click.prevent="vieAll">View All Products</x-primary-button>
        </div> --}}

        <div class="md:flex justify-start">
            <div class="overflow-x-scroll block md:hidden" style="height: 140px">
                @livewire('reseller.resel.categories', ['cat' => $cat])
            </div>
            <div class="hidden md:block text-start" style="width:140px; text-aling:left">
                <div>
                    @livewire('reseller.resel.categories', ['cat' => $cat])
                </div>
            </div>

            <div>

                @if ($products->links())
                    {{$products->links()}}
                @endif
                <div style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px" >
                    @foreach ($products as $pd)
                        @includeIf('components.dashboard.reseller.resel-product-cart')
                    @endforeach
                </div>
            </div>
        </div>
     

    </x-dashboard.container>
</div>

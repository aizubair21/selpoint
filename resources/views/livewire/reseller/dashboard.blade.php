<div >
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div x-init="$wire.getData">

        <div>

            <x-dashboard.container >
                {{-- @include('layouts.vendor.overview.overview') --}}
                <x-dashboard.overview.section>
                    <x-dashboard.overview.div>
                        <x-slot name="title">
                            Product
                        </x-slot>
        
                        <x-slot name="content">
                            {{$tp}}
                        </x-slot>
                    </x-dashboard.overview.div>
                    <x-dashboard.overview.div>
                        <x-slot name="title">
                            Different Category
                        </x-slot>
        
                        <x-slot name="content">
                            {{$category}}
                        </x-slot>
                    </x-dashboard.overview.div>
                    <x-dashboard.overview.div>
                        <x-slot name="title">
                            Vendors
                        </x-slot>
        
                        <x-slot name="content">
                            {{$vendor}}
                        </x-slot>
                    </x-dashboard.overview.div>
                </x-dashboard.overview.section>
        
        
                {{-- <x-dashboard.section.header>
                    <x-slot name="title">
                        Resel Trending Products
                    </x-slot>
                    <x-slot name="content">
                        Resel from trending product of our store.
                    </x-slot>
                </x-dashboard.section.header> --}}
        
               
                <x-hr/>
            </x-dashboard.container>
        
        </div>
        @livewire('reseller.resel.categories', key('resel_101'))
    
        <x-dashboard.container>
            <x-hr/>
            <x-dashboard.section.inner>
                <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, 170px); grid-gap:10px">
                    @foreach ($products as $p)
                        @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $p])
                    @endforeach
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.container>
    </div>
</div>

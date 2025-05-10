<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <x-dashboard.container>
        {{-- @include('layouts.vendor.overview.overview') --}}
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Product
                </x-slot>

                <x-slot name="content">
                    34q3
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Different Category
                </x-slot>

                <x-slot name="content">
                    34q3
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Vendors
                </x-slot>

                <x-slot name="content">
                    34q3
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

        <x-dashboard.section.inner>
            <x-hr/>
            @livewire('reseller.resel.categories', key('resel_101'))
            
        </x-dashboard.section.inner>
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

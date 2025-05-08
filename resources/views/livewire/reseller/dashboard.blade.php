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


        <x-dashboard.section.header>
            <x-slot name="title">
                Resel Trending Products
            </x-slot>
            <x-slot name="content">
                Resel from trending product of our store.
            </x-slot>
        </x-dashboard.section.header>

    <x-dashboard.section.inner>
        <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, 170px); grid-gap:10px">
            @foreach ($products as $p)
                @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $p])
            @endforeach
        </div>

        {{-- <x-modal name="orderProduct" maxWidth="md" >
            <div class="p-3 bold border-b">
                Reseller Order Product
            </div>
            <div class="p-5">
                <form >
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Name" name="name" error="name" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Phone" name="phone" error="phone" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer District" name="district" error="district" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Upozila" name="pozila" error="pozila" />
                    <x-input-field inputClass="w-full" label="Customer Full Address" name="location" error="location" />
                    <x-hr/>
                    <x-input-field inputClass="w-full" class="md:flex" label="Reseller Price" name="price" error="price" />
                    <x-hr/>
                    <x-input-field inputClass="w-full" class="md:flex" label="Product Quantity" name="quantity" error="quantity" />
                    <x-hr/>
                    <x-primary-button>Order</x-primary-button>
                </form>
            </div>
        </x-modal> --}}
    </x-dashboard.section.inner>

    </x-dashboard.container>
</div>

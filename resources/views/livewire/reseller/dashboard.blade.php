<div>
<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div x-init="$wire.getData">

        <div>

            <x-dashboard.container>
            <x-dashboard.container>
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
                            Category
                        </x-slot>

                        <x-slot name="content">
                            {{$category}}
                        </x-slot>
                    </x-dashboard.overview.div>
                    <x-dashboard.overview.div>
                        <x-slot name="title">
                            Shops
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


                <x-hr />


                <x-hr />
            </x-dashboard.container>


        </div>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Chose From Different Category
                </x-slot>
                <x-slot name="content">
                    We have {{$category}} categories, chose as you need from our different category.
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-primary-button @click="$dispatch('open-modal', 'explore-category')">
                    categories
                </x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section>
        <x-dashboard.container>
        </x-dashboard.container>

        <x-hr />
        <x-dashboard.section.inner>
            <div class=""
                style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 170px); grid-gap:10px">
                @foreach ($products as $p)
                @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $p])
                @endforeach
            </div>
        </x-dashboard.section.inner>
        <x-dashboard.container>
        </x-dashboard.container>
        <div class=""
            style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 170px); grid-gap:10px">
            @foreach ($products as $p)
            @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $p])
            @endforeach
        </div>
    </div>

    <x-modal name="explore-category">
        <div class="p-3 border-b">
            Explore Category
        </div>
        @livewire('reseller.resel.categories', key('resel_101'))
        <hr class="my-1" />
        <div class="flex justify-end items-center p-3">
            <x-danger-button @click="$dispatch('close-modal', 'explore-category')">
                close
            </x-danger-button>
        </div>
    </x-modal>
</div>
<div>
    <div>
        {{-- Because she competes with no one, no one can compete with her. --}}

        <div x-init="$wire.getData">

            <div>

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
                            Vendor Shops
                        </x-slot>

                        <x-slot name="content">
                            {{$vendor}}
                        </x-slot>
                    </x-dashboard.overview.div>
                </x-dashboard.overview.section>

            </div>
            <x-hr />


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

            @livewire('vendor.orders.index', ['nav' => 'All', 'create' => 'day', 'start_date' =>
            now()->format('Y-m-d')])

            <x-hr />
            <div wire:navigate.hidden>
                <div
                    style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px">

                    @if (count($products) > 0)

                    @foreach ($products as $p)
                    @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $p])
                    @endforeach
                    <div class="mt-2 text-center">
                        {{$products->links()}}
                    </div>
                    @endif
                </div>
            </div>
            <x-responsive-nav-link href="{{route('reseller.resel-product.index')}}"
                :active="request()->routeIs('reseller.resel-product.*')">
                <i class="fas fa-sync pr-2 w-6"></i> View All
            </x-responsive-nav-link>
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
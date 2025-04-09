<x-app-layout>
    <x-dashboard.page-header>
        Your Products
    </x-dashboard.page-header>

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Products List
                </x-slot>
                <x-slot name="content">
                    Product those have insert in the system or resell form vendor
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                    @php
                        $nav = request('nav') ?? 'own';
                    @endphp
                    <x-nav-link href="{{url()->current()}}/?nav=own" :active="$nav == 'own'">
                        Your Product
                    </x-nav-link>
                    <x-nav-link href="{{url()->current()}}/?nav=resel" :active="$nav == 'resel'">
                        Resel Product
                    </x-nav-link>
            </x-dashboard.section.inner>
        </x-dashboard.section>   
    
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title" class="float-right clearfix">
                    <x-primary-button>
                        Add New Product
                    </x-primary-button>
                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-between items-center">
                        <div>

                            <x-nav-link href="" :active="true">
                                Active
                            </x-nav-link>
                            <x-nav-link href="">
                                In Active
                            </x-nav-link>
                            <x-nav-link href="">
                                Trash
                            </x-nav-link>
                        </div>

                        <div class="flex items-center">
                            <x-text-input type="search" placeholder="Search by name" class="mx-2 hidden lg:block py-1"></x-text-input>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'filter-modal')" >Filter</x-primary-button>
                        </div>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                        </tr>
                    </thead>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</x-app-layout>
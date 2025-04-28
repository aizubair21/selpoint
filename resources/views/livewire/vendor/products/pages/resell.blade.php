<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <x-dashboard.page-header>
        Product Resell 
        <br>
        @include('components.dashboard.vendor.products.navigations')
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{-- Resell  --}}
                </x-slot>
                <x-slot name="content">
                    <div class="flex">
                        <div>
                            <x-dropdown align="left" maxWidth="48">
                                <x-slot name="trigger">
                                    <x-secondary-button>
                                        Day <i class="fa-solid fa-filter ml-3"></i>
                                    </x-secondary-button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="w-full border-b p-2">
                                        <i class="fa-solid fa-check mr-3"></i>    Today
                                    </div>
                                    <div class="w-full border-b p-2">
                                        <i class="fa-solid fa-minus mr-3"></i>    Last Day
                                    </div>
                                    <div class="w-full border-b p-2">
                                        <i class="fa-solid fa-minus mr-3"></i>    This Weak
                                    </div>
                                    <div class="w-full border-b p-2">
                                        <i class="fa-solid fa-minus mr-3"></i>    This Month
                                    </div>
                                    <div class="w-full border-b p-2">
                                        <i class="fa-solid fa-minus mr-3"></i>    Custom
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </x-slot>
            </x-dashboard.section.header>

            {{-- <x-dashboard.foreach></x-dashboard.foreach> --}}

            <x-dashboard.table>
                <thead>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>A/C</th>
                </thead>
            </x-dashboard.table>
        </x-dashboard.section>
    </x-dashboard.container>
</div>

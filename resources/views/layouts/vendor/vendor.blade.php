<x-dashboard.container>
    @include('layouts.vendor.overview.overview')
</x-dashboard.container>

<x-dashboard.container>
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
                Recent Order
            </x-slot>
            <x-slot name="content">
                View Your order from the reseller
            </x-slot>
        </x-dashboard.section.header>

        
    </x-dashboard.section>
</x-dashboard.container>
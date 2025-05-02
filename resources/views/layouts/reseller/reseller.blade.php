

<x-dashboard.container>
    @include('layouts.vendor.overview.overview')
</x-dashboard.container>

<x-dashboard.container>
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
                <h1>Recent Order</h1>
            </x-slot>
            <x-slot name="content">
                View Your order from the reseller
            </x-slot>
        </x-dashboard.section.header>

        <x-dashboard.table>
            <thead>
                <tr>
                    <th>#</th>
                </tr>
            </thead>
        </x-dashboard.table>
    </x-dashboard.section>
</x-dashboard.container>
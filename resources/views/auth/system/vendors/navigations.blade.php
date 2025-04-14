{{-- <x-dashboard.container>
    <x-dashboard.section>
        <x-dashboard.section.inner>
        </x-dashboard.section.inner>
    </x-dahsboard.section>
</x-dashboard.container> --}}

<x-nav-link class="" :active="request()->routeIs('system.vendor.settings')" href="{{route('system.vendor.settings', ['id' => request('id')])}}">Settings</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.documents')" href="{{route('system.vendor.documents', ['id' => request('id')])}}">Documents</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.products')" href="{{route('system.vendor.products', ['id' => request('id')])}}">Products</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.categories')" href="{{route('system.vendor.categories', ['id' => request('id')])}}">Categories</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.orders')" href="{{route('system.vendor.orders', ['id' => request('id')])}}">Order</x-nav-link>
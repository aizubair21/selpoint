{{-- <x-dashboard.container>
    <x-dashboard.section>
        <x-dashboard.section.inner>
        </x-dashboard.section.inner>
    </x-dahsboard.section>
</x-dashboard.container> --}}

<x-nav-link class="" :active="request()->routeIs('system.vendor.settings')" href="{{route('system.vendor.settings')}}">Settings</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.documents')" href="{{route('system.vendor.documents')}}">Documents</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.products')" href="{{route('system.vendor.products')}}">Products</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.categories')" href="{{route('system.vendor.categories')}}">Categories</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.orders')" href="{{route('system.vendor.orders')}}">Order</x-nav-link>
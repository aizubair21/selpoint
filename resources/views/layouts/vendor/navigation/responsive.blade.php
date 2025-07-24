<x-responsive-nav-link href="{{route('vendor.products.view')}}" :active="request()->routeIs('vendor.products.*')">
    Products
</x-responsive-nav-link>

{{-- <x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link> --}}

<x-responsive-nav-link href="{{route('vendor.orders.index')}}" :active="request()->routeIs('vendor.orders.*')">
    Orders
</x-responsive-nav-link>
<x-responsive-nav-link href="">
    Comissions
</x-responsive-nav-link>
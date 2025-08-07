<x-responsive-nav-link href="{{route('vendor.products.view')}}" :active="request()->routeIs('vendor.products.*')">
    <i class="fas fa-layer-group pr-2"></i>Products
</x-responsive-nav-link>

{{-- <x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link> --}}

<x-responsive-nav-link href="{{route('vendor.orders.index')}}" :active="request()->routeIs('vendor.orders.*')">
    <i class="fas fa-sort pr-2 w-6"></i>    Orders
</x-responsive-nav-link>
<x-responsive-nav-link href="">
    <i class="fas fa-money-bill-transfer pr-2 w-6"></i> Comissions
</x-responsive-nav-link>
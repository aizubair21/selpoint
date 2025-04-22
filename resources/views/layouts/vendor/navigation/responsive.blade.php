<x-responsive-nav-link href="{{route('vendor.products.view')}}" :active="request()->routeIs('vendor.products.*')">
    Products
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link>

<x-responsive-nav-link href="">
    Orders
</x-responsive-nav-link>
<x-responsive-nav-link href="">
    Comissions
</x-responsive-nav-link>
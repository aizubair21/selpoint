<x-nav-link href="{{route('vendor.products.view')}}" :active="request()->routeIs('vendor.products.*')" >
    Products
</x-nav-link>

<x-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')" >
    Categories
</x-nav-link>

<x-nav-link href='' >
    Vendors
</x-nav-link>

<x-nav-link href='' >
    Orders
</x-nav-link>

<x-nav-link href='' >
    Comissions
</x-nav-link>
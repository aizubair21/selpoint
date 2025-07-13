<x-responsive-nav-link href="{{route('reseller.products.list')}}" :active="request()->routeIs('reseller.products.*')" >
    Products
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('reseller.order.index')}}" :active="request()->routeIs('reseller.order.*')" >
    Orders
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('reseller.comissions.index')}}" :active="request()->routeIs('reseller.comissions.*')" >
    Comissions
</x-responsive-nav-link>
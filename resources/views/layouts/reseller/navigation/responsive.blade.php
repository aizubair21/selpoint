<x-responsive-nav-link href="{{route('reseller.products.list')}}" :active="request()->routeIs('reseller.products.*')" >
    Your Products
</x-responsive-nav-link>
<x-responsive-nav-link href="{{route('reseller.resel-product.index')}}" :active="request()->routeIs('reseller.resel-product.*')" >
    Resel From Vendor
</x-responsive-nav-link>
{{-- 
<x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link> --}}

<x-responsive-nav-link href="{{route('reseller.order.index')}}" :active="request()->routeIs('reseller.order.*')" >
    Orders
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('reseller.comissions.index')}}" :active="request()->routeIs('reseller.comissions.*')" >
    Comissions
</x-responsive-nav-link>
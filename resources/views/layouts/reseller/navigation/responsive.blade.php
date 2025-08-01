<x-responsive-nav-link href="{{route('reseller.products.list')}}" :active="request()->routeIs('reseller.products.*')" >
    <i class="fas fa-layer-group pr-2 w-6"></i>    Your Products
</x-responsive-nav-link>
<x-responsive-nav-link href="{{route('reseller.resel-product.index')}}" :active="request()->routeIs('reseller.resel-product.*')" >
    <i class="fas fa-sync pr-2 w-6"></i> Resel
</x-responsive-nav-link>
{{-- 
<x-responsive-nav-link href="{{route('vendor.category.view')}}" :active="request()->routeIs('vendor.category.*')">
    Categories
</x-responsive-nav-link> --}}

<x-responsive-nav-link href="{{route('vendor.orders.index')}}" :active="request()->routeIs('vendor.order.*')" >
    <i class="fas fa-sort pr-2 w-6"></i>    Orders
</x-responsive-nav-link>

<x-responsive-nav-link href="{{route('reseller.comissions.index')}}" :active="request()->routeIs('reseller.comissions.*')" >
    <i class="fas fa-money-bill-transfer pr-2 w-6"></i>Comissions
</x-responsive-nav-link>
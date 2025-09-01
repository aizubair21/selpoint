{{-- <x-responsive-nav-link href="{{route('my-shop', ['user' => auth()->user()->name])}}"
    :active="request()->routeIs('my-shop')">
    <i class="fas fa-shop pr-2 w-6"></i> My Info
</x-responsive-nav-link>
<x-hr /> --}}

<x-responsive-nav-link href="{{route('my-shop', ['user' => auth()->user()->name])}}"
    :active="request()->routeIs('my-shop')">
    <i class="fas fa-shop pr-2 w-6"></i> Consignments
</x-responsive-nav-link>

{{-- <x-responsive-nav-link href="{{route('my-shop', ['user' => auth()->user()->name])}}"
    :active="request()->routeIs('my-shop')">
    <i class="fas fa-shop pr-2 w-6"></i> Pending Order
</x-responsive-nav-link> --}}
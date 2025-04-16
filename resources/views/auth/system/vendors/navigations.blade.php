{{-- <x-dashboard.container>
    <x-dashboard.section>
        <x-dashboard.section.inner>
        </x-dashboard.section.inner>
    </x-dahsboard.section>
</x-dashboard.container> --}}
<x-dashboard.section.header>
    <x-slot name="title">
        {{$vendor?->shop_name_en ?? "N/A"}} / {{$vendor?->shop_name_bn ?? "N/a"}}
    </x-slot>
    
    <x-slot name="content">
        <div class="text-sm">
            <x-nav-link href="{{route('system.users.edit', ['email' => $vendor?->user?->email])}}">
                {{$vendor?->user?->name ?? "N/A"}}
            </x-nav-link>
            - {{$vendor?->status ?? "N/A"}}
        </div>
        <span class="text-xs text-gray-400">
            {{$vendor?->created_at?->toFormattedDateString() ?? ""}}
        </span>
    </x-slot>
</x-dashboard.section.header>
<br>
<x-nav-link class="" :active="request()->routeIs('system.vendor.settings')" href="{{route('system.vendor.settings', ['id' => $vendor?->id])}}">Settings</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.documents')" href="{{route('system.vendor.documents', ['id' => $vendor?->id])}}">Documents</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.products')" href="{{route('system.vendor.products', ['id' => $vendor?->id])}}">Products</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.categories')" href="{{route('system.vendor.categories', ['id' => $vendor?->id])}}">Categories</x-nav-link>
<x-nav-link class="" :active="request()->routeIs('system.vendor.orders')" href="{{route('system.vendor.orders', ['id' => $vendor?->id])}}">Order</x-nav-link>
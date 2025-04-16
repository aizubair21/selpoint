<div>

    <x-dashboard.section.header>
        <x-slot name="title">
            {{$reseller?->shop_name_en ?? "N/A"}} / {{$reseller?->shop_name_bn ?? "N/a"}}
        </x-slot>
        
        <x-slot name="content">
            <div class="text-sm">
                <x-nav-link href="{{route('system.users.edit', ['email' => $reseller?->user?->email])}}">
                    {{$reseller?->user?->name ?? "N/A"}}
                </x-nav-link>
                - {{$reseller?->status ?? "N/A"}}
            </div>
            <span class="text-xs text-gray-400">
                {{$reseller?->created_at?->toFormattedDateString() ?? ""}}
            </span>
        </x-slot>
        {{-- @livewire('component', ['user' => $user], key($user->id)) --}}
    </x-dashboard.section.header>
    <br>
    {{-- <x-nav-link class="" :active="request()->routeIs('system.reseller.settings')" href="{{route('system.reseller.settings', ['id' => $reseller?->id])}}">Settings</x-nav-link>
    <x-nav-link class="" :active="request()->routeIs('system.reseller.documents')" href="{{route('system.reseller.documents', ['id' => $reseller?->id])}}">Documents</x-nav-link>
    <x-nav-link class="" :active="request()->routeIs('system.reseller.products')" href="{{route('system.reseller.products', ['id' => $reseller?->id])}}">Products</x-nav-link>
    <x-nav-link class="" :active="request()->routeIs('system.reseller.categories')" href="{{route('system.reseller.categories', ['id' => $reseller?->id])}}">Categories</x-nav-link> --}}
    {{-- <x-nav-link class="" :active="request()->routeIs('system.reseller.orders')" href="{{route('system.reseller.orders', ['id' => $reseller?->id])}}">Order</x-nav-link> --}}

</div>
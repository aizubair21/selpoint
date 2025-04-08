@if(auth()->user()->hasAnyRole(['admin', 'system']))

    @can('admin_view')
        @if (Route::has('system.admin'))
            <x-nav-link :href="route('system.admin')" :active="request()->routeIs('system.admin')">
                {{ __('Admins') }}
            </x-nav-link>
        @endif      
    @endcan

    @can('vendors_view')     
        @if (Route::has('system.vendor.index'))
            <x-nav-link :href="route('system.vendor.index')" :active="request()->routeIs('system.vendor.*')">
                {{ __('Vendor') }}
            </x-nav-link>
        @endif
    @endcan

    @can('resellers_view')                  

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Reseller') }}
        </x-nav-link>
    @endcan 

    @can('riders_view')
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Rider') }}
        </x-nav-link>
    @endcan

@endif    


{{-- dropdown  --}}
@if (auth()->user()->hasRole('system'))    
    {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Role') }}
    </x-nav-link>
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Permission') }}
    </x-nav-link>
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Comission') }}
    </x-nav-link>
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Withdraw') }}
    </x-nav-link>
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Store') }}
    </x-nav-link> --}}

    @can('role_list')
                    
    <x-nav-link :href="route('system.role.list')">
        {{ __('Role') }}
    </x-nav-link>
    @endcan

    @can('users_view')
    <x-nav-link :href="route('system.users.view')">
        {{ __('Users') }}
    </x-nav-link>
    @endcan

    @can('withdraw_manage')
    <x-nav-link :href="route('profile.edit')">
        {{ __('Withdraw') }}
    </x-nav-link>
    @endcan

    <x-nav-link :href="route('profile.edit')">
        {{ __('Comission') }}
    </x-nav-link>
    <x-nav-link :href="route('profile.edit')">
        {{ __('Store') }}
    </x-nav-link>

@endif
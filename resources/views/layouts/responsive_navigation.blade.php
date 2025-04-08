@if (auth()->user()->hasAnyRole(['admin', 'system']))
                    
    @can('admin_view')         
        <x-responsive-nav-link :href="route('system.admin')" :active="request()->routeIs('system.admin')">
            {{ __('Admin') }}
        </x-responsive-nav-link>
    @endcan
    @can('vendors_view')         
        <x-responsive-nav-link :href="route('system.vendor.index')" :active="request()->routeIs('system.vendor.*')">
            {{ __('Vendor') }}
        </x-responsive-nav-link>
    @endcan

    @can('resellers_view')
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Reseller') }}
        </x-responsive-nav-link>
    @endcan 

    @can('riders_view')
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Rider') }}
        </x-responsive-nav-link>
    @endcan

    @can('role_list')
        <x-responsive-nav-link :href="route('system.role.list')">
            {{ __('Role') }}
        </x-responsive-nav-link>
    @endcan 

    @can('users_view')
        <x-responsive-nav-link :href="route('system.users.view')">
            {{ __('Users') }}
        </x-responsive-nav-link>
    @endcan 
@endif

@if (auth()->user()->hasRole('system'))    
    <x-responsive-nav-link :href="route('dashboard')">
        {{ __('Comission') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('dashboard')">
        {{ __('Withdraw') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('dashboard')">
        {{ __('Store') }}
    </x-responsive-nav-link>
@endif
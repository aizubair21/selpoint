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
        <x-responsive-nav-link :href="route('system.reseller.index')" :active="request()->routeIs('system.reseller.*')">
            {{ __('Reseller') }}
        </x-responsive-nav-link>
    @endcan 

    @can('riders_view')
        <x-responsive-nav-link :href="route('system.rider.index')" :active="request()->routeIs('system.rider.*')">
            {{ __('Rider') }}
        </x-responsive-nav-link>
    @endcan
        
    <x-hr/>
    <x-responsive-nav-link :href="route('system.products')" :active="request()->routeIs('system.products.*')">
        {{ __('Products') }}
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('system.orders.index')" :active="request()->routeIs('system.orders.*')">
        {{ __('Orders') }}
    </x-responsive-nav-link>
    
    @if (auth()->user()->hasRole('system'))
        
        <x-responsive-nav-link :href="route('system.comissions.index')" :active="request()->routeIs('system.comissions.*')">
            {{ __('Comission') }}
        </x-responsive-nav-link>

        <x-hr/>
    @endif
    
    @can('role_list')
        <x-responsive-nav-link :href="route('system.vip.users')" :active="request()->routeIs('system.vip.*')">
            {{ __('ViP') }}
        </x-responsive-nav-link>
    @endcan 
    @can('role_list')
        <x-responsive-nav-link :href="route('system.role.list')" :active="request()->routeIs('system.role.*')">
            {{ __('Role') }}
        </x-responsive-nav-link>
    @endcan 

    @can('users_view')
        <x-responsive-nav-link :href="route('system.users.view')" :active="request()->routeIs('system.users.*')">
            {{ __('Users') }}
        </x-responsive-nav-link>
    @endcan 
@endif

@if (auth()->user()->hasRole('system'))    
    <x-responsive-nav-link :href="route('dashboard')">
        {{ __('Withdraw') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('system.store.index')" :active="request()->routeIs('system.store.*')">
        {{ __('Store') }}
    </x-responsive-nav-link>
@endif
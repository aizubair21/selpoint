@if (auth()->user()?->hasRole('admin') || auth()->user()?->hasRole('system'))
    
    @can('users_view')
        <x-responsive-nav-link :href="route('system.users.view')" :active="request()->routeIs('system.users.*')">
            {{ __('Users') }}
        </x-responsive-nav-link>
    @endcan 

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
    @can('role_list')
        <x-responsive-nav-link :href="route('system.role.list')" :active="request()->routeIs('system.role.*')">
            {{ __('Role') }}
        </x-responsive-nav-link>
    @endcan 
        
    <x-hr/>
    @can('product_view')
    <x-responsive-nav-link :href="route('system.products.index')" :active="request()->routeIs('system.products.*')">
        {{ __('Products') }}
    </x-responsive-nav-link>
    @endcan
    @can('category_view')
    <x-responsive-nav-link :href="route('system.categories.index')" :active="request()->routeIs('system.categories.*')">
        {{ __('Categories') }}
    </x-responsive-nav-link>
    @endcan



    {{-- @if (auth()->user()->hasRole('system'))
        

    @endif --}}

    {{-- @can('role_list')
    @endcan  --}}
    @can('vip_view')
        
    <x-responsive-nav-link :href="route('system.vip.users')" :active="request()->routeIs('system.vip.*')">
        {{ __('ViP') }}
    </x-responsive-nav-link>
    @endcan
    @can('slider_view')
        
    <x-responsive-nav-link :href="route('system.slider.index')" :active="request()->routeIs('system.slider.*')">
        {{ __('Slider') }}
    </x-responsive-nav-link>
    @endcan
    {{-- @can('', $post)
        
    @endcan
    <x-responsive-nav-link :href="route('system.navigations.index')" :active="request()->routeIs('system.navigations.*')" >
        {{ __('Navigations') }}
    </x-responsive-nav-link> --}}
    @can('store_view')
    <x-responsive-nav-link :href="route('system.store.index')" :active="request()->routeIs('system.store.*')">
        {{ __('Store') }}
    </x-responsive-nav-link>
    @endcan
        
    <x-hr/>
    @can('deposit_view')

    <x-responsive-nav-link :href="route('system.deposit.index')" :active="request()->routeIs('system.deposit.*')">
    {{ __('Deposit') }}
    </x-responsive-nav-link>
    @endcan

    @can('comission_view')

    <x-responsive-nav-link :href="route('system.comissions.index')" :active="request()->routeIs('system.comissions.*')">
    {{ __('Comission') }}
    </x-responsive-nav-link>
    @endcan

    @can('order_view')

    <x-responsive-nav-link :href="route('system.orders.index')" :active="request()->routeIs('system.orders.*')">
    {{ __('Orders') }}
    </x-responsive-nav-link>
    @endcan

    @can('withdraw_view')

    <x-responsive-nav-link :href="route('system.withdraw.index')" :active="request()->routeIs('*.withdraw.*')">
    {{ __('Withdraw') }}
    </x-responsive-nav-link>
    @endcan
    {{-- @if (auth()->user()->hasRole('system'))    
    @endif --}}
@endif

    @if(auth()->user()->hasAnyRole(['admin', 'system']))
    
       
        @can('vendors_view')     
            @if (Route::has('system.vendor.index'))
                <x-nav-link :href="route('system.vendor.index')" :active="request()->routeIs('system.vendor.*')">
                    {{ __('Vendor') }}
                </x-nav-link>
            @endif
        @endcan
    
        @can('resellers_view')                  
    
            <x-nav-link :href="route('system.reseller.index')" :active="request()->routeIs('system.reseller.*')">
                {{ __('Reseller') }}
            </x-nav-link>
        @endcan 

        @can('users_view')
            <x-nav-link :href="route('system.users.view')" :active="request()->routeIs('system.users.*')">
                {{ __('Users') }}
            </x-nav-link>
        @endcan
    
      
    
    @endif    
    
    
    {{-- dropdown  --}}
    @if (auth()->user()->hasRole('system'))    
    
        <div class="flex items-center">
            <x-dropdown class="self-center">
                <x-slot name="trigger">
                    <x-secondary-button>more</x-secondary-button>
                </x-slot>
                <x-slot name="content">

                    @can('admin_view')
                        @if (Route::has('system.admin'))
                            <x-dropdown-link :href="route('system.admin')" :active="request()->routeIs('system.admin')">
                                {{ __('Admins') }}
                            </x-dropdown-link>
                        @endif      
                    @endcan

                    @can('riders_view')
                        <x-dropdown-link :href="route('system.rider.index')" :active="request()->routeIs('system.rider.*')">
                            {{ __('Rider') }}
                        </x-dropdown-link>
                    @endcan
                    <x-hr/>
                        <x-dropdown-link :href="route('system.products')">
                            Products
                        </x-dropdown-link>
                    <x-hr/>


                    @can('role_list')           
                        <x-dropdown-link :href="route('system.vip.users')" :active="request()->routeIs('system.vip.*')">
                            {{ __('VIP') }}
                        </x-dropdown-link>
                    @endcan
                
                    @can('role_list')           
                        <x-dropdown-link :href="route('system.role.list')" :active="request()->routeIs('system.role.*')">
                            {{ __('Role') }}
                        </x-dropdown-link>
                    @endcan
                
                    @can('withdraw_manage')
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Withdraw') }}
                    </x-dropdown-link>
                    @endcan
                   
                    <x-dropdown-link :href="route('system.slider.index')" >
                        {{ __('Slider') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('navigations.index')">
                        {{ __('Navigations') }}
                    </x-dropdown-link>
                
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Comission') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('system.store.index')">
                        {{ __('Store') }}
                    </x-dropdown-link>
        
                </x-slot>
            </x-dropdown>
        </div>
    
    
    @endif

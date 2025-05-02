
<style>
    .cart-count {
        position: absolute;
        top: 15px;
        right: 14.9em;
        background-color: red;
        color: white;
        font-size: 12px;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 6px;
        transform: translate(50%, -50%);
    }

    .navbar-expand-lg .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
</style>
<?php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
?>
@auth
    @php
        // $count = DB::table('carts')
        //     ->where('user_id', Auth::user()->id)
        //     ->count();
        $count = "";
    @endphp
@endauth
<header class="bg-white">
    <x-dashboard.container>
        <div>
            <nav class="flex justify-between items-center">
              
                <x-nav-link class="" href="/"><img style="height: 50px;" src="{{asset('logo.png')}}" alt="#" /></x-nav-link>
                <div class="d-flex flex-grow-1" id="navbarSupportedContent">
                    <ul class="flex items-center">
                        
                    
                        @auth
                            <li class="nav-item light">
                                {{-- <x-nav-link class="py-2" :href="route('user.index')">
                                    Switch to Vendor
                                </x-nav-link> --}}
                                <x-nav-link wire:navigate class="py-2" :href="route('user.index')">
                                    Home
                                </x-nav-link>
                            </li> 
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 mx-2  border rounded text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        {{auth()->user()->name}}
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
            
                                <x-slot name="content">
                                    <x-dropdown-link>
                                        Cart
                                    </x-dropdown-link>
            
            
                                    {{--  role-based architecture  --}}
                                        @php
                                            $roles = auth()->user()->getRoleNames();
                                        @endphp
                                        @if (count($roles) > 0)
                                            <x-dropdown-link class="bold" target="_blank" :href="route('dashboard')">
                                                Go To Dashboard
                                            </x-dropdown-link>
                                            
                                            {{-- @if (auth()->user()->hasRole('vendor'))
                                                <x-dropdown-link wire:navigate class="bold" target="_blank" :href="route('dashboard')">
                                                    Vendor Dashboard
                                                </x-dropdown-link>
                                            @endif
                                            @if (auth()->user()->hasRole('reseller'))
                                                <x-dropdown-link wire:navigate class="bold" target="_blank" :href="route('dashboard')">
                                                    Reseller Dashboard
                                                </x-dropdown-link>
                                            @endif
                                            @if (auth()->user()->hasRole('rider'))
                                                <x-dropdown-link wire:navigate class="bold" target="_blank" :href="route('dashboard')">
                                                    Rider Dashboard
                                                </x-dropdown-link>
                                            @endif --}}
                                        @endif
                                    {{--  role-based architecture  --}}
                            
                                    {{-- special permission  --}}
                                    <div class="py-2">
                                            @can('vendors_navigation')                                
                                                <x-dropdown-link wire:navigate href="{{route('system.vendor.index')}}" class="text-green bold border-b">
                                                    Manage Vendor
                                                </x-dropdown-link>
                                            @endcan
            
                                            @can('resellers_navigation')
                                            <x-dropdown-link wire:navigate class="text-green bold border-b">
                                                Manage Reseller
                                            </x-dropdown-link>
                                            @endcan
            
                                            @can('riders_navigation')
                                            <x-dropdown-link wire:navigate class="text-green bold border-b">
                                                Manage D. Man
                                            </x-dropdown-link>
                                            @endcan 
            
                                            @can('users_navigation')
                                            <x-dropdown-link wire:navigate class="text-green bold border-b">
                                                Manage Users
                                            </x-dropdown-link>
                                            @endcan
                                        
                                    </div>
                                    {{-- special permission  --}}
            
                                    <x-dropdown-link>
                                        Profile
                                    </x-dropdown-link>
                                    {{-- @if (Route::has('logout'))
                                        <form method="get" action="{{ route('logout') }}">
                                            @csrf
            
                                            <x-dropdown-link wire:navigate :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    @endif --}}
                                    <x-dropdown-link href="{{route('logout')}}">
                                        Log Out
                                    </x-dropdown-link>
                                    {{-- <x-secondary-button wire:click="logout">
                                        {{ __('Log Out') }}
                                    </x-secondary-button>    --}}
                                    {{-- @livewire('livewire.page.auth.logout') --}}
                                    {{-- @livewire('component', ['user' => $user], key($user->id)) --}}
                                </x-slot>
                            </x-dropdown>
                        
                        @else
                            
                            <li class="nav-item">
                                <a wire:navigate style="color:white;width: 7em;" class="nav-link btn-success" href="{{route('register')}}">Sign Up</a>
                            </li>
            
                            <li class="nav-item">
                                <a wire:navigate style="color:white;margin-left:5px;" class="nav-link btn-danger" href="{{route('login')}}">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </x-dashboard.container>
</header>
<!-- end header section -->
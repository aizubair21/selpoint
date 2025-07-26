
<?php 
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;
use function Livewire\Volt\{computed};
 
$count = computed(function () {
    return auth()->user() ? auth()->user()->myCarts()->count() : "0";
});

new class extends Component{
    /**
     * Log the current user out of the application.
     */
     public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}


?> 

<style>
    @media (max-width:991px){
        .cart-count {
            position: absolute;
            top: 5px!important;
            right: 0px!important;
            background-color: green;
            font-weight: bold;
            color: white;
            font-size: 9px;
            font-weight: bold;
            border-radius: 50%;
            padding: 0px 4px;
            transform: translate(50%, -50%);
        }
    }
    .cart-count {
        position: absolute;
        top: 5px;
        right: 0px;
        background-color: green;
        font-weight: bold;
        color: white;
        font-size: 9px;
        font-weight: bold;
        border-radius: 50%;
        padding: 0px 4px;
        transform: translate(50%, -50%);
    }

    .navbar-expand-lg .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
</style>

<header class="bg-white">
    <x-dashboard.container>
        <div>
            <nav class="flex justify-between items-center">
              
                <a wire:navigate class="" href="/"><img style="height: 50px;" src="{{asset('logo.png')}}" alt="#" /></a>
                <div class="" id="navbarSupportedContent">
                    <ul class="flex items-center">
        
                        <li>
                            <a wire:navigate href="{{route('home')}}">
                                Home
                            </a>
                        </li> 
                        <li class="px-2">
                            <div class="relative">
                                <a wire:navigate class="nav-link " href="{{route('carts.view')}}"><i class="fas fa-shopping-cart" ></i> <span class="cart-count">{{auth()->user()->myCarts()->count() ?? "0"}}</span></a>
                            </div>
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
                                {{-- <x-dropdown-link>
                                    Cart
                                </x-dropdown-link> --}}
                                {{-- <x-dropdown-link href="{{route('carts.view')}}" class="mr-3">
                                    <button type="button" class="btn relative">
                                        <i class="fas fa-cart-plus"></i> Cart
                                        <span id="displayCartItem" class="ml-3 absolute top-0 start-100 translate-middle badge rounded-lg">
                                            {{auth()->user()->myCarts()->count() ?? "0"}}
                                        </span>
                                    </button>
                                </x-dropdown-link> --}}
        
                                {{--  role-based architecture  --}}
                                    @php
                                        $roles = auth()->user()->getRoleNames();
                                    @endphp
                                    @if (count($roles) > 1)
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
        
                                <x-dropdown-link href="{{route('edit.profile')}}">
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
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                                
                            </x-slot>
                        </x-dropdown>
                    </ul>
                       
                </div>
            </nav>
        </div>
    </x-dashboard.container>
</header>
<!-- end header section -->
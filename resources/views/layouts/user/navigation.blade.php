<?php 

 
use App\Models\cart;
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributs\On;
use function Livewire\Volt\{computed};
 
// $count = computed(function () {
//     return auth()->user() ? auth()->user()->myCarts()->count() : "0";
// });

new class extends Component {

    public $count = 0;
    protected $listeners = ['$refresh'];

    public function mount() 
    {
        $this->count();    
    }
    
    #[On('cart')]
    public function count() 
    {
        $this->count = auth()->user() ? auth()->user()->myCarts()->count() : "0";
        // $this->count ++;
    }
    
    /**
     * Log the current user out of the application.
     */
     public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function login() 
    {
        $this->redirect('/login', navigate:true);    
    }
    
}
?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a wire:navigate href="/" :active="request()->routeIs('/')">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')">
                        {{ __('Categories') }}
                    </x-nav-link>

                
                </div>
            </div>

            <!-- Settings Dropdown -->

            <div class="flex items-center">

                <x-nav-link href="{{route('carts.view')}}" class="mr-3">
                    <button type="button" class="btn flex items-center">
                        <i class="fas fa-cart-plus"></i>
                        <span id="displayCartItem" class="pb-3 text-green">
                          @auth
                            @volt('cart')
                                <div>
                                    {{$this->count ?? "0"}}
                                </div>
                            @endvolt
                          @endauth
                          @guest
                              0
                          @endguest
                          {{-- <span class="visually-hidden">unread messages</span> --}}
                        </span>
                    </button>
                </x-nav-link>
    
                @auth     
                    <div class="flex">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center px-3 py-2 border border text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name ?? "Unauthorize" }}</div>
        
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
        
                                <x-slot name="content">
                                    
                                    <x-dropdown-link :href="route('user.index')">
                                        {{ __('User Panel') }}
                                    </x-dropdown-link>
                                
                                   
                                    {{-- <hr>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Change Password') }}
                                    </x-dropdown-link>
                                    <hr> --}}

                                    @if (count(auth()->user()->getRoleNames()) > 1)
                                        <x-dropdown-link wire:navigate class="bold" target="_blank" :href="route('dashboard')">
                                            Dashboard
                                        </x-dropdown-link>
                                    @endif
                                    
                                    
        
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                @endauth
                @guest
                    <x-nav-link class=" px-3 text-md uppercase hidden md:block" :href="route('login')" >
                        login
                    </x-nav-link>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                Products
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')">
                Categories
            </x-responsive-nav-link>

           
        </div>

        <!-- Responsive Settings Options -->
        @auth    
            <div class="pt-4 pb-1 border-t border border-gray-200">
            
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>


                    
                </div>
            </div>
        @endauth
        @guest    
            <x-responsive-nav-link :href="route('login')">
                {{ __('login') }}
            </x-responsive-nav-link>
        @endguest
    </div>
</nav>

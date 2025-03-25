<!-- header section strats -->
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
<header class="header_section">
<div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      
        <a class="navbar-brand" href="/"><img style="height: 50px;" src="{{asset('logo.png')}}" alt="#" /></a>
        <div class="d-flex flex-grow-1" id="navbarSupportedContent">
        <ul class="navbar-nav">
            
           
            @auth
                <li class="nav-item light">
                    <x-nav-link class="py-2" :href="route('user.index')">
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
                        <hr>
                        {{-- special permission  --}}
                        <div class="py-2">

                            <x-dropdown-link >
                                Manage Vendor
                            </x-dropdown-link>
                            <x-dropdown-link >
                                Manage Reseller
                            </x-dropdown-link>
                            <x-dropdown-link >
                                Manage D. Man
                            </x-dropdown-link>
                            <x-dropdown-link >
                                Manage Users
                            </x-dropdown-link>
                            
                        </div>
                        {{-- special permission  --}}
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
               
            @else
                
                <li class="nav-item">
                    <a style="color:white;width: 7em;" class="nav-link btn-success" href="{{route('register')}}">Sign Up</a>
                </li>

                <li class="nav-item">
                    <a style="color:white;margin-left:5px;" class="nav-link btn-danger" href="{{route('login')}}">Login</a>
                </li>
            @endauth
        </ul>
        </div>
    </nav>
</div>
</header>
<!-- end header section -->
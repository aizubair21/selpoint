<div class="bg-white text-center">

    {{-- normal nav on desktop --}}
    <div class="w-full px-3 max-w-7xl mx-auto flex justify-between items-center" id="desktop-nav">
        
        {{-- logo  --}}
        <div class="flex items-center">
            <img height="50px" width="60px" src="{{asset('icon.png')}}" alt="">
            <div class="ps-2 text-2xl font-bold">ERUHI</div>
        </div>

        {{-- search  --}}
        <div class="hidden md:flex justify-start items-center flex-1 w-full px-4" id="search_content">
            <style>
                .nv-shop-item{
                    height: auto;
                    z-index: 9;
                }
                .nv-shop-btn:hover .nv-shop-item{
                    display: block;
                    transition: all linear .3s;
                }
            </style>
            <div class="pe-4 w-48 max-w-md nv-shop-btn relative" id="">
                <div class="flex items-center justify-center cursor-pointer">
                    <div>Shop</div>
                    <i class=" px-3 pb-2 fas fa-sort-down"></i>
                </div>



                <div id="" class="nv-shop-item hidden absolute left-0 border shadow bg-white" style="top:100%" >
                   <div class="flex flex-wrap justify-start items-start">
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                        <a href="">Home </a>
                   </div>
                </div>
            </div>

            <div class="relative border flex-1">
                <input type="search" name="" placeholder="Search Product By Title or Tasgs" class="border-0 shadow-0 focus:border-0 focus:shadow-0 w-full" id="">
            </div>
        </div>


        {{-- right content  --}}
        <div>
            @auth     
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
    
                    <div class="flex">
                        <div class="flex sm:items-center sm:ms-6">
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
                </div>
            @endauth
            @guest
                <x-nav-link class=" px-3 text-md uppercase " :href="route('login')" >
                    login
                </x-nav-link>
            @endguest
        </div>
    </div>
</div>

{{-- sticky nav  --}}
<div class="bg-white w-full fixed z-50 top-0 left-0" id="sticky-nav">

    <div class="w-full px-3 max-w-7xl mx-auto flex justify-between items-center"> 
        {{-- logo  --}}
        <div class="flex items-center">
            <button class="border-r px-2">
                <i class="fas fa-align-justify text-lg"></i>
            </button>
            <div class="flex items-center">
                <img height="40px" width="40px" src="{{asset('icon.png')}}" alt="">
                <div class="ps-2 text-md md:text-lg hidden md:block lg:text-3xl font-bold">ERUHI</div>
            </div>
        </div>

        {{-- search  --}}
        {{-- <div class="flex justify-start items-center flex-1 w-full px-4" id="search_content">
            <style>
                #nv-shop-btn:hover #nv-shop-item{
                    display: block
                }
            </style>
            <div class="pe-4 w-48 max-w-md flex items-center justify-center cursor-pointer relative group group/item h-20" id="nv-shop-btn">
                <div>Shop</div>
                <i class=" px-3 pb-2 fas fa-sort-down"></i>



                <div id="nv-shop-item" class="group/edit hidden absolute bottom-0 left-0 w-48 h-48 border shadow bg-white group-hover/item:block" >

                </div>
            </div>

            <div class="relative border flex-1">
                <input type="search" name="" placeholder="Search Product By Title or Tasgs" class="border-0 shadow-0 focus:border-0 focus:shadow-0 w-full" id="">
            </div>
        </div> --}}


        {{-- right content  --}}
        <div>

            <div class="flex items-center justify-between">
                <button class="rounded mx-2">
                    <i class="fas fa-search text-md p-2"></i>
                </button>
                @auth     
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

                    <div class="flex">
                        <div class="flex sm:items-center sm:ms-6">
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
                    <x-nav-link class=" px-3 text-md uppercase " href="/login" >
                        login
                    </x-nav-link>
                @endguest
            </div>
        </div>
    </div>

</div>

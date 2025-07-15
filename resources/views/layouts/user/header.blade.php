<?php 

 
use App\Models\cart;
use App\Models\Navigations;
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributs\On;
use function Livewire\Volt\{computed};
 
// $count = computed(function () {
//     return auth()->user() ? auth()->user()->myCarts()->count() : "0";
// });

new class extends Component {

    public $count = 0, $navigations = [];
    protected $listeners = ['$refresh'];

    public function mount() 
    {
        $this->count();
        $this->navigations = Navigations::with('links')->get();
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


<div class="bg-white text-center">

    {{-- normal nav on desktop --}}
    <div class="w-full px-3 max-w-8xl mx-auto flex justify-between items-center" id="desktop-nav">
        
        {{-- logo  --}}
        <a wire:navigate href="/" class="flex items-center">
            <img height="50px" width="60px" src="{{asset('icon.png')}}" alt="">
            <div class="ps-2 text-2xl font-bold">ERUHI</div>
        </a>

        {{-- search  --}}
        <div class="hidden md:flex justify-start items-center flex-1 w-full px-4" id="search_content">
            <style>
                .nv-shop-item{
                    height: auto;
                    z-index: 9;
                }

                /* @media (max-width:570px){
                    .nv-shop-item{
                        width:350px
                    }
                }
                @media (min-width : 570px) and (max-width:990px)
                {
                    .nv-shop-item{
                        width:570px;
                    }
                }
                @media (min-width : 990px){
                    .nv-shop-item {
                        width:900px
                    }
                } */

                .nv-shop-btn:hover .nv-shop-item{
                    display: block;
                    transition: all linear .3s;
                }
            </style>
            <div class="pe-4 max-w-md nv-shop-btn relative" id="" style="width:200px">
                <div class="flex items-center justify-center cursor-pointer">
                    <div>Shop</div>
                    <i class=" px-3 pb-2 fas fa-sort-down"></i>
                </div>

                <div id="" class="w-auto nv-shop-item hidden absolute left-0 border shadow bg-white" style="top:100%;" >
                   <div class="">
                       @volt()
                            <div class=" flex items-start">

                                @foreach ($navigations as $item)

                                    <div class="text-start p-2 " style="width:150px">
                                        <div class="font-bold pb-2">
                                            {{$item->name ?? "N/A"}}
                                        </div>

                                        <div class="block">
                                            @foreach ($item->links as $nl)    
                                                <x-nav-link class="block">{{$nl->name ?? "N/A"}}</x-nav-link>
                                            @endforeach
                                            
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        @endvolt
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
<div class="bg-white w-full fixed z-50 top-0 left-0" id="sticky-nav" x-data="{open:false}">

    <div class="w-full px-3 max-w-8xl mx-auto flex justify-between items-center" x-data="{search:false}"> 
        {{-- logo  --}}
        <div class="flex items-center">
            <button class="border-r px-2" x-on:click="open = !open">
                <i x-show="!open" class="fas fa-align-justify text-lg"></i>
                <i x-show="open" class="fas fa-times text-lg"></i>
            </button>
            <div class="flex items-center">
                <img height="40px" width="40px" src="{{asset('icon.png')}}" alt="">
                <div class="ps-2 text-md md:text-lg hidden md:block lg:text-3xl font-bold">ERUHI</div>
            </div>
        </div>

        {{-- search  --}}
        <div x-show="search" x-transition class="absolute bottom-0 left-0 flex justify-between items-center flex-1 w-full px-4  " id="search_content">
            <div class="relative w-full flex-1 px-2">
                <input type="search" name="" autofocus placeholder="Search Product By Title or Tasgs" class="border-0 shadow-0 blur:border-0 blur:shadow-0 w-full" id="">
            </div>
            <button x-on:click="search = !search">
                <i class="fas fa-times"></i>
            </button>
        </div>


        {{-- right content  --}}
        <div>

            <div class="flex items-center justify-between">
                <button class="rounded mx-2" x-on:click="search = !search">
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



    {{-- other side nav  --}}
    <div class="fixed left-0 h-screen bg-white shadow-lg overflow-y-scroll" x-show="open" style="top:40px;width:250px;">
        @volt()
            <div>

                @foreach ($navigations as $item)    
                    <div class="p-3 border-b bg-gray-100 mb-1" x-data="{display:false}">
                        {{-- btn  --}}
                        <button class="flex justify-between items-center w-full" x-on:click="display = !display">
                            {{$item->name ?? "N/A"}}
                            <i x-show="display" class="fas fa-sort-up"></i>
                            <i x-show="!display" class="fas fa-sort-down"></i>
                        </button>

                        {{-- content  --}}
                        <div x-show="display">
                            @foreach ($item->links as $il)
                                
                                <div class="py-1">
                                    <x-nav-link class="block"> {{$il->name ?? "N/A"}} </x-nav-link>
                                </div>
                            @endforeach
                            {{-- <div class="py-1">
                                <x-nav-link class="block">Home</x-nav-link>
                            </div>
                            <div class="py-1">
                                <x-nav-link class="block">Home</x-nav-link>
                            </div>
                            <div class="py-1">
                                <x-nav-link class="block">Home</x-nav-link>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endvolt

    </div>

</div>

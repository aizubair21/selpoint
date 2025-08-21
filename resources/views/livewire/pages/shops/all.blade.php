<div>
    @livewire('pages.slider')

    <div class="py-4">
        <div >
            <div class=" w-full text-center w-auto  heading_center mb-3 text-3xl">
                <h2 class="flex gap-3 justify-center">
                    <x-application-name  /> <span class="font-bold text-green-900" >Shops</span>
                </h2>
            </div>
        </div>
    </div>
    <x-dashboard.container>

        <div class="md:flex justify-between items-center space-y-2">

            <div class="flex justify-start items-center py-3">
                <x-nav-link href="/">
                    <i class="fas fa-home pe-2"></i>
                </x-nav-link>
                {{-- <i class="fas fa-slash-back px-2 py-0 m-0"></i> --}}
                <x-nav-link href="{{route('shops')}}">
                    <x-application-name /> <div class="px-2">Shops</div>
                </x-nav-link>
            </div>
        
            <div class="flex items-center">
                <input type="search" wire:model.live="q" class="py-1 rounded-md" placeholder="search shops" id="">
                <div>
                    @auth
                        <div @click="$dispatch('open-modal', 'shop-location-modal')" class="py-2 px-3 text-xs ms-1 border rounded bg-white">
                            {{ !empty($location) ? $location : auth()->user()->city ?? 'ANY'}} <i class="ps-2 fas fa-chevron-down"></i>
                        </div>
                    @else 
                        <div @click="$dispatch('open-modal', 'shop-location-modal')" class="px-2">
                            <i class="fas fa-location"></i>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        {{-- <div style="display: grid; grid-template-columns:repeat(auto-fit, 300px); justify-content:start; align-items:start; gird-gap:10px">

            <x-client.shops-cart/>
            
        </div> --}}
        @guest
            <div class="w-full text-center p-1 bg-gray-200  ">
                Login to get access the shops based on your location.
            </div>
        @endguest
        @if ($q || $location)
            {{$shops->links()}}
           <div style="display: grid; grid-template-columns:repeat(auto-fit, 300px); justify-content:start; align-items:start; grid-gap:10px">

                @if (count($shops) > 0)
                    @foreach ($shops as $shop)
                        <x-client.shops-cart :$shop :key="$shop->id"/>
                    @endforeach
                @else
                    <p>
                        No Shops Found !
                    </p>
                @endif
            </div>
        @else 
            @livewire('pages.shops.shop-list')
        @endif
   
        <x-modal name="shop-location-modal" maxWidth="sm">
            <div class="p-3" x-data="{tab : me}">
                <p class="text-xs ">
                    Shop will be displayed based on you expectation. From where you want to get the shop.
                </p>
                <br>
                <div class="text-center space-y-3">
                    @auth    
                        <x-primary-button wire:click="getShopByMyLocation" class="p-3 flex justify-center items-center bg-indigo-300 text-white w-full rounded"> 
                            My Location ({{auth()->user()->city}}) <i class="px-2 fas fa-location"></i>
                        </x-primary-button>
                    @endauth

                    <x-secondary-button wire:click="getAllShops" class="p-3 w-full flex justify-center items-centere">
                        All Shops
                    </x-secondary-button>

                    <div class="p-2 rounded bg-gray-200">
                        <input type="search" wire:model.live="location" id="find_shop" class="py-1 w-full rounded mb-1" placeholder="search shop by state, city or town">
                    </div>

                </div>
            </div>
        </x-modal>
    </x-dashboard.container>

</div>

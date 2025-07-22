<div>
    @livewire('pages.slider')

    <x-client.common-heading />
    <x-dashboard.container>
        <div class="flex justify-start items-center py-3 mb-3">
            <x-nav-link href="/">
                <i class="fas fa-home pe-2"></i>
            </x-nav-link>
            {{-- <i class="fas fa-slash-back px-2 py-0 m-0"></i> --}}
            <x-nav-link href="{{route('shops')}}">
                Shops
            </x-nav-link>
        </div>
        <x-hr/>

        {{-- <div style="display: grid; grid-template-columns:repeat(auto-fit, 300px); justify-content:start; align-items:start; gird-gap:10px">

            <x-client.shops-cart/>
            
        </div> --}}
        @livewire('pages.shops.shop-list')
    </x-dashboard.container>
</div>

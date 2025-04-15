<div>
    
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
                Vendor Request
            </x-slot>
            <x-slot name="content">
                Edit and Upgrade Your Vendor Request Form <a href="{{route('upgrade.vendor.index')}}">Previous Request</a>
                
            </x-slot>
        </x-dashboard.section.header>
    
        <x-dashboard.section.inner>
            @php
                $nav = request('nav') ?? "basic";
            @endphp
            <div class="flex justify-between">
                <div>

                    <x-nav-link :active="$nav == 'basic'" href="?nav=basic">
                        Basic 
                    </x-nav-link>
                    <x-nav-link :active="$nav == 'document'" href="?nav=document">
                        Document
                    </x-nav-link>
                
                </div>
                
                <div>
                    <x-nav-link href="{{route('upgrade.vendor.create')}}">New Request</x-nav-link>
                </div>
            </div>
        </x-dashboard.section.inner>
    </x-dashboard.section>
    
    @if ($nav == 'basic')    
        {{-- <form action="{{route('upgrade.vendor.update', ['id' => $data->id])}}" method="post">  --}}
        <form wire:submit.prevent="update"> 
            {{-- @includeIf('user.pages.profile-upgrade.vendor.partials.basic') --}}
            {{-- @include('name', ) --}}

            <x-dashboard.section>
                <x-dashboard.section.inner>
                    {{-- <x-dashboard.section class="bg-gray-100"> --}}

                    <x-input-field :data="$data??[]" label="Your Shop Name English" wire:model.live="vendor.shop_name_en" name="shop_name_en" error="shop_name" />
                    <x-input-field :data="$data??[]" label="Your Shop Name bangla" wire:model.live="vendor.shop_name_bn" name="shop_name_bn" error="shop_name" />
                    <x-input-field :data="$data??[]" type="number" label="Your Shop Phone" wire:model.live="vendor.phone" name="phone" error="phone" :value="auth()->user()->phone" />
                    <x-input-field :data="$data??[]" type="email" label="Your Shop email" wire:model.live="vendor.email" name="email" error="email" :value="auth()->user()->email" />
                
                        
                </x-dashboard.section.inner>
            </x-dashboard.section>

            <x-dashboard.section>
            <x-dashboard.section.inner>

                <x-input-field :data="$data??[]" wire:model.live="vendor.country" label="Your Country" name="country" error="country" />
                <x-input-field :data="$data??[]" wire:model.live="vendor.district" label="District/State" name="district" error="district" />
                <x-input-field :data="$data??[]" wire:model.live="vendor.upozila" label="Upozila/ City" name="upozila" error="upozila" />
                <x-input-field :data="$data??[]" wire:model.live="vendor.village" label="Village" name="village" error="village" />
                <x-input-field :data="$data??[]" wire:model.live="vendor.zip" label="Zip Code" name="zip" error="zip" />
                <x-input-field :data="$data??[]" wire:model.live="vendor.road_no" label="Road No" name="road_no" error="road_no" />                
                <x-input-field :data="$data??[]" wire:model.live="vendor.house_no" label="House No" name="house_no" error="house_no" />

                {{-- add a wire navigating feature to button  --}}
                {{-- <x-button wire:click="save" class="bg-blue-500 hover:bg-blue- 700 text-white font-bold py-2 px-4 rounded">Save</x-button> --}}
                <x-primary-button >
                    Submit
                </x-primary-button>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        </form>
    @endif
    @if($nav == 'document')
    
        @includeIf('user.pages.profile-upgrade.vendor.partials.document')
    
    @endif

</div>
    
<div>

    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
                {{$upgrade}} request
            </x-slot>
            <x-slot name="content">
                Edit and Upgrade Your Vendor Request Form <a href="{{route('upgrade.vendor.index', ['upgrade' => $upgrade])}}">Previous Request</a>
                <br>
               {{-- <x-client.upgrade-status :upgrade="$upgrade" :$id /> --}}
               @includeIf('components.client.upgrade-status')
            </x-slot>
        </x-dashboard.section.header>
    
        <x-dashboard.section.inner>
            
            {{-- @php
                $nav = request('nav') ?? "basic";
            @endphp --}}

            <div class="flex justify-between">
                <div>

                    <x-nav-link :active="$nav == 'basic'" href="?upgrade={{$upgrade}}&nav=basic">
                        Basic 
                    </x-nav-link>
                    <x-nav-link :active="$nav == 'document'" href="?upgrade={{$upgrade}}&nav=document">
                        Document
                    </x-nav-link>
                
                </div>
                
                <div>
                    <x-nav-link href="{{route('upgrade.vendor.create', ['upgrade' => $upgrade])}}">New Request</x-nav-link>
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

                    <x-input-field label="Your Shop Name English" wire:model.live="vendor.shop_name_en" name="shop_name_en" error="shop_name" />
                    <x-input-field label="Your Shop Name bangla" wire:model.live="vendor.shop_name_bn" name="shop_name_bn" error="shop_name" />
                    <x-input-field type="number" label="Your Shop Phone" wire:model.live="vendor.phone" name="phone" error="phone" :value="auth()->user()->phone" />
                    <x-input-field type="email" label="Your Shop email" wire:model.live="vendor.email" name="email" error="email" :value="auth()->user()->email" />
                
                        
                </x-dashboard.section.inner>
            </x-dashboard.section>

            <x-dashboard.section>
            <x-dashboard.section.inner>

                <x-input-field wire:model.live="vendor.country" label="Your Country" name="country" error="country" />
                <x-input-field wire:model.live="vendor.district" label="District/State" name="district" error="district" />
                <x-input-field wire:model.live="vendor.upozila" label="Upozila/ City" name="upozila" error="upozila" />
                <x-input-field wire:model.live="vendor.village" label="Village" name="village" error="village" />
                <x-input-field wire:model.live="vendor.zip" label="Zip Code" name="zip" error="zip" />
                <x-input-field wire:model.live="vendor.road_no" label="Road No" name="road_no" error="road_no" />                
                <x-input-field wire:model.live="vendor.house_no" label="House No" name="house_no" error="house_no" />

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
    
        {{-- @includeIf('user.pages.profile-upgrade.vendor.partials.document') --}}
        <form wire:submit.prevent="updateDocument">
            <x-dashboard.section>
                <x-dashboard.section.inner>
                    
                    <x-input-field wire:model="vendorDocument.nid" label="Your NID No" name="nid" error="nid" />

                    <x-input-file label="Your NID Image (front side)" error='nid_front'>
                            
                            @if ($vendorDocument && $vendorDocument['nid_front'] && !$nid_front)
                                <img width="100px" src="{{asset('/storage/vendor-document/'.$vendorDocument['nid_front'])}}" alt="">
                            @endif
                            @if($nid_front) 
                                <img width="100px" src="{{$nid_front->temporaryUrl()}}" alt="">
                            @endif
                        
                            <x-text-input accept="png, jpg, jpeg" type="file" wire:model.live="nid_front" />
                    </x-input-file>
                    <x-input-file label="Your NID Image (back side)" error='nid_back'>
                            @if ($vendorDocument && $vendorDocument['nid_back'] && !$nid_back)
                                <img width="100px" src="{{asset('/storage/vendor-document/'.$vendorDocument['nid_back'])}}" alt="">
                            @endif
                            @if($nid_back) 
                                <img width="100px" src="{{$nid_back->temporaryUrl()}}" alt="">
                            @endif
                            <x-text-input type="file" wire:model.live="nid_back" />
                    </x-input-file>
                    <x-hr />
                    <x-input-file label="Your TIN No" error='nid'>
                            <x-text-input type="number" wire:model="vendorDocument.shop_tin" type="text" name="nid" placeholder="NID" />
                    </x-input-file>
                    <x-input-file label="Your TIN Image (front side)" error='shop_tin'>
                             @if ($vendorDocument && $vendorDocument['shop_tin_image'] && !$shop_tin_image)
                                <img width="100px" src="{{asset('/storage/vendor-document/'.$vendorDocument['shop_tin_image'])}}" alt="">
                            @endif
                            @if($shop_tin_image) 
                                <img width="100px" src="{{$shop_tin_image->temporaryUrl()}}" alt="">
                            @endif
                            <x-text-input type="file" wire:model.live="shop_tin_image" />
                    </x-input-file>

                    <x-hr />
                    <x-input-field wire:model="vendorDocument.shop_trade" label="Your business Trade Number" name="shop_trade" error="shop_trade" />
                    <x-input-file label="Your Trade License Image (front side)" error='shop_trade_image'>
                             @if ($vendorDocument && $vendorDocument['shop_trade_image'] && !$shop_trade_image)
                                <img width="100px" src="{{asset('/storage/vendor-document/'.$vendorDocument['shop_trade_image'])}}" alt="">
                            @endif
                            @if($shop_trade_image) 
                                <img width="100px" src="{{$shop_trade_image->temporaryUrl()}}" alt="">
                            @endif
                            <x-text-input type="file" wire:model.live="shop_trade_image" />
                    </x-input-file>

                    <x-hr/>
                    <x-primary-button>
                        submit
                    </x-primary-button>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        </form>
    
    @endif

</div>
    
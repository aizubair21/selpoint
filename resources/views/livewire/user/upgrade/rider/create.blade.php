<div>
    <x-dashboard.section >
        <x-dashboard.section.header>
            <x-slot name="title">
             Rider Request Form
            </x-slot>

            <x-slot name="content">
                Request to be a Rider | 
                <a wire:navigate href="{{route('upgrade.rider.index')}}" class="">
                    previous request
                </a>
          
            </x-slot>
        </x-dashboard.section.header>
    </x-dashboard.section>


    <form wire:submit.prevent="store" content-typ="multipart/form-data" class="w-full">
        <x-dashboard.section>
            <x-dashboard.section.inner>
                <div class="md:flex">
                    <div class="p-2 flex-1">
                        <x-input-field label="Your Phone No" name="phone" error="phone" wire:model.live="phone" error="phone" placeholder="Your phone No" class="w-full"  />
                        <x-input-field label="Your Email" name="email" error="email" wire:model.live="email" error="email" placeholder="Your email" class="w-full"  />
                        <x-hr/>

                        <x-input-field label="Your NID No" name="nid" error="nid" wire:model.live="nid" error="nid" placeholder="Your NID No" class="w-full"  />

                        <x-input-file label="You NID Front Image (max 1Mb)" name="nid_photo_front" error="nid_photo_front">
                            @if ($nid_photo_front)
                                <img src="{{$nid_photo_front->temporaryUrl()}}" alt="NID Front" style="width: 200px; height:100px" srcset="">
                            @endif
                            <input type="file"  wire:model="nid_photo_front" id="nid_front">
                        </x-input-file>
                        <x-input-file label="You NID Back Image (max 1Mb)" name="nid_photo_back" error="nid_photo_back">
                            @if ($nid_photo_back)
                                <img src="{{$nid_photo_back->temporaryUrl()}}" alt="NID Back" style="width: 200px; height:100px" srcset="">
                            @endif
                            <input type="file"  wire:model="nid_photo_back" id="nid_back">
                        </x-input-file>
                    </div>


                    <div class="p-2 flex-1">
                        <x-input-file label="Please select the area where you will pick up and deliver parcelsea" name="area_condition" error="area_condition">
                           
                            <div class="flex items-center justify-start border rounded-lg shadow-sm px-3 py-2">
                                <x-text-input type="radio" name="area_condition" :checked='true' class="mr-3 m-0" value="dhaka" wire:model.live="area_condition" id="area_condition_1" />
                                <x-input-label for="area_condition_1" class="m-0">Inside of Dhaka</x-input-label>
                            </div>
                            <div class="flex items-center justify-start border rounded-lg shadow-sm px-3 py-2">
                                <x-text-input type="radio" name="area_condition" class="mr-3 m-0" value="other" wire:model.live="area_condition" id="area_condition_2" />
                                <x-input-label for="area_condition_2" class="m-0"> Outside Of Dhaka </x-input-label>
                            </div>
                        </x-input-file>
                        <x-hr/>
                        <div  wire:show="area_condition == 'other'" wire:transition>
                            <p class="text-xs">
                                If you selected "Outside Of Dhaka", please specify your targeted district or upazila. Where from and which areas you will provide service. Area could your entire district or a upazila.
                            </p>
                            <x-input-file label="" name="targeted_area" error="targeted_area">
                                <x-text-input wire:model.live="targeted_area" placeholder="Write Your Targeted District" />
                            </x-input-file>
                        </div>
                       
                    </div>

                </div>
                <x-hr/>
                 <x-input-file label="You Fixed Address" name="fixed_address" error="fixed_address" class="block">
                    <p class="text-xs">
                        Your permanent address based on NID. This address will be used for verification purposes. We use this address to verify your location and provide better service. 
                    </p>
                    <textarea  wire:model.live="fixed_address" class="w-full" id="" placeholder="Your Permanent Address based on NID "></textarea>
                </x-input-file>
                <x-input-file label="You Current Address" name="current_address" error="current_address">
                    <p class="text-xs"> 
                        Your current address where you are living now. You will receive the parcel from this address. 
                    </p>
                    <p class="text-xs">
                        Please provide any additional information about your current address that may help us verify your location.
                    </p>
                    <textarea  wire:model.live="current_address" class="w-full" id="" placeholder="Your Current Address"></textarea>
                </x-input-file>
                <x-hr/>
                <x-primary-button> <i class="fas fa-file-alt pr-2"></i> Confirm</x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </form>

    @php
        // dd(auth()->user()->requestsToBeRider()->latest()->first());
    @endphp
</div>

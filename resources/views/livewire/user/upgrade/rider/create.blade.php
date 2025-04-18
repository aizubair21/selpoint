<div>
    <x-dashboard.section >
        <x-dashboard.section.header>
            <x-slot name="title">
             rider Request Form
            </x-slot>

            <x-slot name="content">
                Request to be a vendor | 
                <a wire:navigate href="{{route('upgrade.rider.index')}}" class="">
                    previous request
                </a>
               
            </x-slot>
        </x-dashboard.section.header>
    </x-dashboard.section>


    <form wire:submit.prevent="store">
        <x-dashboard.section>
            <x-dashboard.section.inner>
                <x-input-file label="You phone No" name="phone" error="phone">
                    <x-text-input class="form-control" wire:model.live="phone" id="" placeholder="Your phone No "/>
                </x-input-file>
                <x-input-file label="You email No" name="email" error="email">
                    <x-text-input type="email" class="form-control" wire:model.live="email" id="" placeholder="Your email No "/>
                </x-input-file>
                <x-hr />

                <x-input-file label="You NID No" name="nid" error="nid">
                    <x-text-input class="form-control" wire:model.live="nid" id="" placeholder="Your NID No "/>
                </x-input-file>
                
                <x-input-file label="You NID Front Image" name="nid_photo_front" error="nid_photo_front">
                    <input type="file" class="form-control" wire:model.live="nid_photo_front" id="">
                </x-input-file>
                <x-input-file label="You NID Back Image" name="nid_photo_back" error="nid_photo_back">
                    <input type="file" class="form-control" wire:model.live="nid_photo_back" id="">
                </x-input-file>
                
                <x-hr />
                <x-input-file label="You Fixed Address" name="fixed_address" error="fixed_address">
                    <textarea class="form-control" wire:model.live="fixed_address" id="" placeholder="Your Permanent Address based on NID "></textarea>
                </x-input-file>
                <x-input-file label="You Current Address" name="current_address" error="current_address">
                    <textarea class="form-control" wire:model.live="current_address" id="" placeholder="Your Current Address based on NID "></textarea>
                </x-input-file>
            </x-dashboard.section.inner>
        </x-dashboard.section>
        
        <x-dashboard.section>
            <x-dashboard.section.inner>
                <x-input-file label="Chose Your Area" name="area_condition" error="area_condition">

                    <div class="flex items-center justify-start border rounded-lg shadow-sm px-3 py-2">
                        <x-text-input type="radio" name="area_condition" :checked='true' class="mr-3 m-0" value="dhaka" wire:model.live="area_condition" id="area_condition_1" />
                        <x-input-label for="area_condition_1" class="m-0">Inside of Dhaka</x-input-label>
                    </div>
                    <div class="flex items-center justify-start border rounded-lg shadow-sm px-3 py-2">
                        <x-text-input type="radio" name="area_condition" class="mr-3 m-0" value="other" wire:model.live="area_condition" id="area_condition_2" />
                        <x-input-label for="area_condition_2" class="m-0"> Outside Of Dhaka </x-input-label>
                    </div>
                    <x-hr/>
                    <br>
                </x-input-file>
                <div  wire:show="area_condition == 'other'" wire:transition>     
                    <x-input-file label="" name="targeted_area" error="targeted_area">
                        <x-text-input wire:model.live="targeted_area" placeholder="Write Your Targeted District" />
                    </x-input-file>
                </div>
                <x-primary-button>save</x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </form>

    @php
        // dd(auth()->user()->requestsToBeRider()->latest()->first());
    @endphp
</div>

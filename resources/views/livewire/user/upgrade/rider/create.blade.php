<div>
    <x-dashboard.section >
        <x-dashboard.section.header>
            <x-slot name="title">
             rider Request Form
            </x-slot>

            <x-slot name="content">
                Request to be a vendor
                <x-nav-link href="{{route('upgrade.rider.index')}}" class="">
                    previous request
                </x-nav-link>
               
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
                
                <x-primary-button>save</x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </form>
</div>

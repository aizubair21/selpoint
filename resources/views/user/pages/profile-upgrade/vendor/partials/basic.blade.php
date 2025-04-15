
    <x-dashboard.section>
        <x-dashboard.section.inner>
            {{-- <x-dashboard.section class="bg-gray-100"> --}}

            <x-input-field :data="$data??[]" label="Your Shop Name English" wire:model.live="shop_name_en" name="shop_name_en" error="shop_name" />
            <x-input-field :data="$data??[]" label="Your Shop Name bangla" wire:model.live="shop_name_bn" name="shop_name_bn" error="shop_name" />
            <x-input-field :data="$data??[]" type="number" label="Your Shop Phone" wire:model.live="phone" name="phone" error="phone" :value="auth()->user()->phone" />
            <x-input-field :data="$data??[]" type="email" label="Your Shop email" wire:model.live="email" name="email" error="email" :value="auth()->user()->email" />
        
                
        </x-dashboard.section.inner>
    </x-dashboard.section>

    <x-dashboard.section>
    <x-dashboard.section.inner>

        <x-input-field :data="$data??[]" wire:model.live="country" label="Your Country" name="country" error="country" />
        <x-input-field :data="$data??[]" wire:model.live="district" label="District/State" name="district" error="district" />
        <x-input-field :data="$data??[]" wire:model.live="upozila" label="Upozila/ City" name="upozila" error="upozila" />
        <x-input-field :data="$data??[]" wire:model.live="village" label="Village" name="village" error="village" />
        <x-input-field :data="$data??[]" wire:model.live="zip" label="Zip Code" name="zip" error="zip" />
        <x-input-field :data="$data??[]" wire:model.live="road_no" label="Road No" name="road_no" error="road_no" />                
        <x-input-field :data="$data??[]" wire:model.live="house_no" label="House No" name="house_no" error="house_no" />

        {{-- add a wire navigating feature to button  --}}
        {{-- <x-button wire:click="save" class="bg-blue-500 hover:bg-blue- 700 text-white font-bold py-2 px-4 rounded">Save</x-button> --}}
        <x-primary-button >
            Submit
        </x-primary-button>
        </x-dashboard.section.inner>
    </x-dashboard.section>
</form>
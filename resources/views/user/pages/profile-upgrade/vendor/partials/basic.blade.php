
    <x-dashboard.section>
        <x-dashboard.section.inner>
            {{-- <x-dashboard.section class="bg-gray-100"> --}}

            <x-input-field :data="$data??[]" label="Your Shop Name English" wire:model.live="shop_name_en" name="shop_name_en" error="shop_name" :required='false' />
            <x-input-field :data="$data??[]" label="Your Shop Name bangla" wire:model.live="shop_name_bn" name="shop_name_bn" error="shop_name" :required='true' />
            <x-input-field :data="$data??[]" type="number" label="Your Shop Phone" wire:model.live="phone" name="phone" error="phone" :value="auth()->user()->phone" :required='true' />
            <x-input-field :data="$data??[]" type="email" label="Your Shop email" wire:model.live="email" name="email" error="email" :value="auth()->user()->email" :required='true' />
        
                
        </x-dashboard.section.inner>
    </x-dashboard.section>

    <x-dashboard.section>
    <x-dashboard.section.inner>

        <x-input-field :data="$data??[]" wire:model.live="country" label="Your Country" name="country" error="country" :required='true' />
        <x-input-field :data="$data??[]" wire:model.live="district" label="District/State" name="district" error="district" :required='true' />
        <x-input-field :data="$data??[]" wire:model.live="upozila" label="Upozila/ City" name="upozila" error="upozila" :required='true' />
        <x-input-field :data="$data??[]" wire:model.live="village" label="Village" name="village" error="village" :required='true' />
        <x-input-field :data="$data??[]" wire:model.live="zip" label="Zip Code" name="zip" error="zip" :required='true' />
        <x-input-field :data="$data??[]" wire:model.live="road_no" label="Road No" name="road_no" error="road_no" :required='true' />                
        <x-input-field :data="$data??[]" wire:model.live="house_no" label="House No" name="house_no" error="house_no" :required='true' />

        {{-- add a wire navigating feature to button  --}}
        {{-- <x-button wire:click="save" class="bg-blue-500 hover:bg-blue- 700 text-white font-bold py-2 px-4 rounded">Save</x-button> --}}
        <x-primary-button >
            Submit
        </x-primary-button>
        </x-dashboard.section.inner>
    </x-dashboard.section>
</form>
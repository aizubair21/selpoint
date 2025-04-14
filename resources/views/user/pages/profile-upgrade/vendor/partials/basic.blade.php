
    <x-dashboard.section>
        <x-dashboard.section.inner>
            {{-- <x-dashboard.section class="bg-gray-100"> --}}

            <x-input-field :data="$data??[]" label="Your Shop Name English" name="shop_name_en" error="shop_name" :required='true' />
            <x-input-field :data="$data??[]" label="Your Shop Name bangla" name="shop_name_bn" error="shop_name" :required='true' />
            <x-input-field :data="$data??[]" type="number" label="Your Shop Phone" name="phone" error="phone" :value="auth()->user()->phone" :required='true' />
            <x-input-field :data="$data??[]" type="email" label="Your Shop email" name="email" error="email" :value="auth()->user()->email" :required='true' />
        
                
        </x-dashboard.section.inner>
    </x-dashboard.section>

    <x-dashboard.section>
    <x-dashboard.section.inner>

        <x-input-field :data="$data??[]" label="Your Country" name="country" error="country" :required='true' />
        <x-input-field :data="$data??[]" label="District/State" name="district" error="district" :required='true' />
        <x-input-field :data="$data??[]" label="Upozila/ City" name="upozila" error="upozila" :required='true' />
        <x-input-field :data="$data??[]" label="Village" name="village" error="village" :required='true' />
        <x-input-field :data="$data??[]" label="Zip Code" name="zip" error="zip" :required='true' />
        <x-input-field :data="$data??[]" label="Road No" name="road_no" error="road_no" :required='true' />                
        <x-input-field :data="$data??[]" label="House No" name="house_no" error="house_no" :required='true' />

        <x-primary-button>
            Submit
        </x-primary-button>
        </x-dashboard.section.inner>
    </x-dashboard.section>
</form>
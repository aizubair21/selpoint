<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $country = '';
    public String $country_code = '';
    public string $state = '';
    public string $city = '';
    public string $dob = '';
    public string $bio = '';
    public string $line1 = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name ?? '';
        $this->email = Auth::user()->email ?? '';
        $this->phone = Auth::user()->phone ?? '';
        $this->country = Auth::user()->country ?? '';
        $this->country_code = Auth::user()->country_code ?? '';
        $this->state = Auth::user()->state ?? '';
        $this->city = Auth::user()->city ?? '';
        $this->dob = Auth::user()->dob ?? '';
        $this->bio = Auth::user()->bio ?? '';
        $this->line1 = Auth::user()->line1 ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            // ignore phone number unique when update only this current user
            'phone' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        // add other data to validate array
        $validated['country'] = $this->country;
        $validated['country_code'] = $this->country_code;
        $validated['state'] = $this->state;
        $validated['city'] = $this->city;
        $validated['dob'] = $this->dob;
        $validated['bio'] = $this->bio;
        $validated['line1'] = $this->line1;
    


        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; 

?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full" required autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
      
        <div>
            <x-input-label for="country" :value="__('Country')" />
            <div class="flex">
                {{-- <input type="text" disabled class="border-0" style="width:60px" wire:model.live="country_code" id="country_code" /> --}}
                {{-- <x-text-input wire:model="country" id="select_country" name="country" type="search" list="countries" class="border-0 mt-1 block w-full" required autocomplete="country" /> --}}
                <select name="" id="select_country" wire:model="country" class="rounded border-0 ring-1 block mt-1 w-full">
                    <option value="">Select your country</option>
                </select>
            </div>
            <datalist id="countries">
            </datalist>
            <x-input-error class="mt-2" :messages="$errors->get('cocuntry')" />
        </div>
        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input wire:model="state" id="state" name="state" type="text" class="mt-1 block w-full" required autocomplete="state" />
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input wire:model="city" id="city" name="city" type="text" class="mt-1 block w-full" required autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>
        <div>
            <x-input-label for="line1" :value="__('Address')" />
            <x-text-input wire:model="line1" id="line1" name="line1" type="text" class="mt-1 block w-full"  autocomplete="line1" />
            <x-input-error class="mt-2" :messages="$errors->get('line1')" />
        </div>
        <x-hr/>
        <div>
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input wire:model="dob" id="dob" name="dob" type="date" class="mt-1 block w-full"  autocomplete="dob" />
            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
        </div>
       

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"></script>
    <script>

        function getCountryStateCity(country = '') {
            axios.get("https://api.countrystatecity.in/v1/countries", {
                headers: {
                    "X-CSCAPI-KEY": "eldObUl5V0Q4MWpiaXFQeEpNSEVVSTlBU1R5ZlU5OE5ORmRra1dxRg==",
                }
            })
            .then(res => {

                res.data.forEach(cntry => {
                    let option = document.createElement("option");
                    option.value = cntry.name;
                    option.setAttribute('data-iso2', cntry.iso2);

                    // set the country code to the hidden input

                    // make selected if country is already set
                    if (country) {
                        // country = cntry.name;
                        if (cntry.name.toUpperCase() == country.toUpperCase()) {
                            option.selected = true;
                        }
                    }
                    option.textContent = cntry.name;
                    document.getElementById('select_country').appendChild(option);
                });
            })
            .then(error => {
                console.log(error);
            })
        }
        
        document.getElementById('select_country').addEventListener('change', function (e) {
            const sop = this.options[this.selectedIndex];
            countryCode = sop.getAttribute('data-iso2');
            // set the country code to the hidden input
            document.getElementById('country_code').value = countryCode;
            console.log(countryCode);
            // getCountryStateCity();
        });

        document.getElementById('select_country').addEventListener('click', (e) =>{
            // let countryCode = e.getAttribute('data-iso2');
            if(e.target.children.length == 1){
                getCountryStateCity();
            };
            
        });
        getCountryStateCity('{{ $country }}');
    </script>
</section>

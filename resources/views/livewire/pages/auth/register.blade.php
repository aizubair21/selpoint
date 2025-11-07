<?php

use App\Models\User;
use App\Models\user_has_refs as uref;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $reference;
    public $phone = '';
    public $country = '';
    public $city = '';
    public $state = '';
    public $country_code = '';

    

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required'],
            'city' => ['required', 'string', 'max:255'],
            'state' => 'required',
            'country' => 'required',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);


        if ($this->country == 'Bangladesh') {
            // if selected country is Bangladesh, set currency to 'BDT', and currency_sing to '৳'
            $validated['currency'] = 'BDT';
            $validated['currency_sing'] = '৳';

        }else {
            // else set currency to 'USD', '$'
            $validated['currency'] = 'USD';
            $validated['currency_sing'] = '$';
        }

        // set country code
        $validated['country_code'] = $this->country_code;
        

        //validate the reference 
        if ( !empty($this->reference) && uref::where(['ref' => $this->reference])->exists()) {
            $validated['reference'] = $this->reference;
            $validated['reference_accepted_at'] = \Carbon\Carbon::now();    
        }else{
            $validated['reference'] = config('app.ref');    
        }

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full bg-white p-4" style="max-width:800px">
    <style>
        .pasDiv {
            position: relative;
            width: 100% !important;
        }

        .showOrHide {

            position: absolute;
            top: 13px;
            right: 10px;
            /* transform: translateY(-50%); */
            /* background-color: #3498db; */
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
    <form wire:submit="register">

        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class=" lg:flex items-start justify-between mb-4 w-full">
            <div>
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                        autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="pasDiv">
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                            name="password" required autocomplete="new-password" />
                        <div onclick="showOrHide(this, '#password')" class="showOrHide">show</div>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="pasDiv">
                        <x-text-input wire:model="password_confirmation" id="password_confirmation"
                            class="block mt-1 w-full" type="password" name="password_confirmation" required
                            autocomplete="new-password" />
                        <div onclick="showOrHide(this, '#password_confirmation')" class="showOrHide">show</div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- phone number --}}
                <div class="mt-4">
                    <x-input-label for="phone" value='Phone Number'></x-input-label>

                    <x-text-input wire:model="phone" id="rejerence" class="block mt-1 w-full" type="text"
                        name="phone" />

                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>


                {{-- referrence --}}
                <div class="mt-4">
                    <x-input-label for="reference" value='Reference'></x-input-label>
                    <p class="text-sm text-gray-600">If you have a reference, please enter it. If not, leave it blank.
                    </p>

                    <x-text-input wire:model="reference" id="rejerence" class="block mt-1 w-full" type="text"
                        name="reference" />

                    <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                </div>

            </div>
            {{-- <div>
                <input type="search" id="country_list" name="country_list" list="country_lists">
                <datalist id="country_lists">
                    <option value="Ban" />
                    <option value="Ind" />
                    <option value="Jap" />
                </datalist>
            </div>

            <label for="browser">Choose your browser from the list:</label>
            <input list="browsers" name="browser" id="browser">

            <datalist id="browsers">
                <option value="Edge">
                <option value="Firefox">
                <option value="Chrome">
                <option value="Opera">
                <option value="Safari">
            </datalist> --}}

            <div>
                {{-- country field --}}
                <div class="mt-4">
                    <x-input-label for="country" value='Your Country'></x-input-label>
                    {{-- <p class="text-sm text-gray-600">Please select your country.</p> --}}

                    {{--
                    <x-text-input type="search" list="countries" wire:model="country" id="country"
                        class="block mt-1 w-full" type="text" name="country" />
                    <datalist id="countries">
                        <option value="Bangladesh" data-con='BD' />
                    </datalist> --}}
                    <input type="hidden" wire:model.live="country_code" id="country_code" />
                    <select wire:model="country" id="select_country" class="rounded border-0 ring-1 block mt-1 w-full">
                        <option value="">Select your country</option>
                    </select>

                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                {{-- state field --}}
                <div class="mt-4" id="state_main">
                    <x-input-label for="Division / State" value='Division / State'></x-input-label>
                    <p class="text-sm text-gray-600">Please select your State.</p>

                    {{--
                    <x-text-input wire:model="district" id="district" class="block mt-1 w-full" type="text"
                        name="district" /> --}}
                    <select wire:model="state" id="select_state" class="rounded border-0 ring-1 block mt-1 w-full">
                        <option value="">Select your state</option>
                    </select>

                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>
                <div class="mt-4 hidden" id="state_alt">
                    <x-input-label for="Division / State" value='Division / State'></x-input-label>
                    <p class="text-sm text-gray-600">Write Your State / Division Name.</p>

                    
                    <x-text-input wire:model="state" id="district" class="block mt-1 w-full" type="text"
                        name="district" />
                    {{-- <select wire:model="state" id="select_state" class="rounded border-0 ring-1 block mt-1 w-full">
                        <option value="">Select your state</option>
                    </select> --}}

                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>


                {{-- state field --}}
                <div class="mt-4">
                    <x-input-label for="District / City" value='District / City'></x-input-label>
                    <p class="text-sm text-gray-600">Please select your District / City.</p>

                    {{--
                    <x-text-input wire:model="district" id="district" class="block mt-1 w-full" type="text"
                        name="district" /> --}}
                    <select wire:model="city" id="select_city" class="rounded border-0 ring-1 block mt-1 w-full">
                        <option value="">Select your City</option>
                    </select>

                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>


                {{-- state field --}}
                {{-- <div class="mt-4">
                    <x-input-label for="Upozila / Town" value='Town'></x-input-label>
                    <p class="text-sm text-gray-600">Please select your Town.</p>

                    <x-text-input wire:model="upozila" id="upozila" class="block mt-1 w-full" type="text"
                        name="upozila" />
                    <x-input-error :messages="$errors->get('district')" class="mt-2" />
                </div> --}}




                {{-- <p class="text-sm text-gray-600">By registering, you agree to our <a href="{{ route('terms') }}"
                        class="text-blue-500 underline">Terms of Service</a> and <a href="{{ route('privacy') }}"
                        class="text-blue-500 underline">Privacy Policy</a>.</p> --}}
            </div>
        </div>
        <x-hr />

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"></script>
    <script>
        function showOrHide(div, input) {
            if (div.textContent === 'show') {
                div.textContent = 'hide';
                document.querySelector(input).type = 'text';
            } else {
                div.textContent = 'show';
                document.querySelector(input).type = 'password';
            }
        }

        let countryCode = '';
        function getCountryStateCity() {
            const countrySelectElement = document.getElementById('select_country');
            const stateSelectElement = document.getElementById("select_state");
            const citySelectElement = document.getElementById("select_city");


            // get country name and set to country select element
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
                        option.textContent = cntry.name;
                        countrySelectElement.appendChild(option);
                    })
                })
                .then(error => {
                    // console.log(error);
                })

            //if country change call api for state data
            countrySelectElement.addEventListener('change', function () {
                const sop = this.options[this.selectedIndex];
                countryCode = sop.getAttribute('data-iso2');
                // set the country code to the hidden input
                
                countryCode2 = sop.getAttribute('data-iso2');
                console.log('code is ' + countryCode);
                
                if (countryCode == "BD") {
                    // console.log("Bangladesh selected");
                    stateSelectElement.style.display = 'none';
                    document.getElementById('state_main').classList.add('hidden');
                    document.getElementById('state_alt').classList.remove('hidden');
                } else {
                    stateSelectElement.style.display = 'block';
                    document.getElementById('state_main').classList.remove('hidden');
                    document.getElementById('state_alt').classList.add('hidden');   
                    
                }
                // console.log("https://api.countrystatecity.in/v1/countries/" + countryCode + "/states");
                axios.get("https://api.countrystatecity.in/v1/countries/" + countryCode + "/states", {
                        headers: {
                            "X-CSCAPI-KEY": "eldObUl5V0Q4MWpiaXFQeEpNSEVVSTlBU1R5ZlU5OE5ORmRra1dxRg==",
                        }
                    })
                    .then(res => {
                        let htmlOption = '';
                        let ifBd = "";
                        res.data.forEach(state => {
                            if (countryCode == "BD") {
                                // console.log(state);
                                console.log(countryCode);
                                if (state.iso2.length > 0) {
                                    //get name without  'District' from state.name
                                    var str = state.name;
                                    var newstr = str.replace(/ District$/, "");

                                    ifBd +=
                                        `
                                        <option value="${newstr}">${newstr}</option>
                                    
                                        `;
                                }
                            } else {
                                
                                htmlOption +=
                                    `
                                    <option value="${state.iso2}">${state.name}</option>
                                    
                                    `;
                            }
                            htmlOption +=
                                `
                                <option value="${state.iso2}">${state.name}</option>
                                
                                `;
                        })
                        stateSelectElement.innerHTML = htmlOption;
                        citySelectElement.innerHTML = ifBd;
                    })
                    .then(error => {
                        console.log(error);
                    })
            })


            //if change state call api for city
            stateSelectElement.addEventListener("input", (e) => {
                // let countryCode = document.getElementById('select_country').getAttribute('data-iso2');
                let cityCode = e.target.value;
                console.log(countryCode, cityCode);
                axios.get("https://api.countrystatecity.in/v1/countries/" + countryCode + "/states/" + cityCode + "/cities", {
                        headers: {
                            "X-CSCAPI-KEY": "eldObUl5V0Q4MWpiaXFQeEpNSEVVSTlBU1R5ZlU5OE5ORmRra1dxRg==",
                        }
                    })
                    .then(res => {
                        let htmlOption = "";
                        // console.log(res.data[0]);
                        res.data.forEach(ct => {
                            htmlOption +=
                                `
                                <option value="${ct.name}">${ct.name}</option>
                                `;
                        })
                        citySelectElement.innerHTML = htmlOption;
                    })
                    .then(error => {
                        console.log(error);
                    })
            })
        }


        document.getElementById('select_country').addEventListener('click', (e) =>{
            // let countryCode = e.getAttribute('data-iso2');
            if(e.target.children.length == 1){
                getCountryStateCity();
            };
            
        });

        // document.getElementById('country').addEventListener('change', (e) => {
        //     console.log(e.target.data);
            
        // })

        // getCountryStateCity();
    </script>
</div>
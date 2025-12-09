<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-dashboard.page-header>
        Countries
    </x-dashboard.page-header>
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
                <div class="flex items-center justify-between">
                    <div>
                        Countries List
                    </div>
                </div>
            </x-slot>
            <x-slot name="content">
                List of all countries available in the system along with their states count.
                <br>

                {{-- search for a country to view its states. --}}
                <div class="flex items-center">

                    <input type="search" placeholder="Search Country..."
                        class="mt-2 px-2 py-1 border border-gray-300 rounded-md w-full" wire:model.live="searchTerm" />

                    <x-primary-button class="ml-2 mt-2" x-on:click="$dispatch('open-modal', 'country-new')">
                        New
                    </x-primary-button>
                </div>
            </x-slot>
        </x-dashboard.section.header>

        <x-dashboard.section.inner>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>

                        <th scope="col">
                            #
                        </th>
                        <th scope="col">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Country Name
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Code
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            phonecode
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            States Count
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($countries as $key => $country)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $country['id'] }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <x-text-input type="text" wire:model="countries.{{ $key }}.name" />

                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <x-text-input type="text" wire:model="countries.{{ $key }}.code" />
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <x-text-input type="text" wire:model="countries.{{ $key }}.phonecode" />
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ count($country['states']) }}
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <x-nav-link-btn
                                    href="{{ route('system.geolocations.states', ['country' => $country['id']]) }}">
                                    View
                                </x-nav-link-btn>
                                <x-danger-button>
                                    Delete
                                </x-danger-button>
                                <x-primary-button wire:click="updateCountry({{ $country['id'] }}, {{ $key }})">
                                    Update
                                </x-primary-button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-dashboard.section.inner>


        <x-modal name="country-new" focusable>
            <form wire:submit.prevent="createCountry">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">New Country</h2>
                    <div class="mt-4">
                        <x-input-label for="country-name" value="Country Name" />
                        <x-text-input id="country-name" placeholder="Country Name" type="text" class="mt-1 block w-full"
                            wire:model.defer="newCountryName" required autofocus />
                        {{--
                        <x-input-error for="newCountryName" class="mt-2" /> --}}
                    </div>

                    <div class="flex justify-between mt-4">
                        {{-- additional details --}}
                        {{-- phone code --}}
                        <div class="w-1/2 mr-2">
                            <x-input-label for="phone-code" value="Phone Code" />
                            <x-text-input id="phone-code" placeholder="+1" type="text" class="mt-1 block w-full"
                                wire:model.defer="newCountryPhoneCode" required />
                            {{--
                            <x-input-error for="newCountryPhoneCode" class="mt-2" /> --}}
                        </div>
                        {{-- country code --}}
                        <div class="w-1/2 ml-2">
                            <x-input-label for="country-code" value="Country Code" />
                            <x-text-input id="country-code" placeholder="US" type="text" class="mt-1 block w-full"
                                wire:model.defer="newCountryCode" required />
                            {{--
                            <x-input-error for="newCountryCode" class="mt-2" /> --}}
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-md">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button class="ml-3" type="submit">
                        Create
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

    </x-dashboard.section>
</div>
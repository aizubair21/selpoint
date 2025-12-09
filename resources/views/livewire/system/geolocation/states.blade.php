<div>
    <x-dashboard.page-header>
        States
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex items-center justify-between">
                        <div>
                            States List
                        </div>
                        <x-primary-button class="ml-4" x-on:click="$dispatch('open-modal', 'add-state-modal')">
                            <i class="fas fa-plus mr-2"></i> State
                        </x-primary-button>
                    </div>
                </x-slot>
                <x-slot name="content">
                    List of states for the selected country.
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <div class="flex items-center mb-4 gap-2">
                    <x-select wire:model.live="country" class="mr-4">
                        <option value="">Select Country</option>
                        @foreach (\App\Models\Country::orderBy('name','asc')->get() as $country)
                        <option value="{{ $country->id }}"> {{$country->id}} - {{ $country->name }}</option>
                        @endforeach

                    </x-select>
                    <input type="text" wire:model.live="search" placeholder="Search States..."
                        class="input input-bordered w-full rounded-md" />


                </div>
                <div class="">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country Id</th>
                                <th>
                                    <!-- Actions -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $key => $state)
                            <tr>
                                <td>
                                    <span class="px-2"> {{$loop->iteration}} </span>
                                </td>
                                <td>
                                    {{ $state['id'] }}
                                </td>
                                <td>
                                    <x-text-input wire:model.defer="states.{{$key }}.name" type="text"
                                        class="input input-bordered w-full" />
                                </td>
                                <td>
                                    <x-text-input wire:model.defer="states.{{$key }}.country_id" type="text"
                                        class="input input-bordered w-full" />
                                </td>
                                <td>
                                    <!-- Actions -->
                                    <div class="flex gap-2 px-3">

                                        {{-- view the cities of the state --}}
                                        <x-nav-link-btn
                                            href="{{ route('system.geolocations.cities', ['country' => $country, 'state_id' => $state['id']]) }}"
                                            class="btn btn-sm btn-info">
                                            Cities
                                        </x-nav-link-btn>
                                        {{-- delete the state --}}
                                        <x-danger-button class="btn btn-sm btn-error"
                                            wire:click="deleteState({{ $state['id'] }})">
                                            Delete
                                        </x-danger-button>

                                        {{-- update the state name --}}
                                        <x-primary-button class="btn btn-sm btn-primary"
                                            wire:click="updateState({{ $state['id'] }}, {{ $key }})">
                                            Update
                                        </x-primary-button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>


        <x-modal name="add-state-modal" focusable>
            <form wire:submit.prevent="addState">
                <div class="p-2">
                    Add New State
                </div>
                <div class="p-2">
                    <div class="space-y-4 w-full gap-2">
                        <div>
                            <x-input-label for="country-id" value="Country" />
                            <x-select id="country-id" class="mt-1 block w-full" wire:model.defer="newState.country_id"
                                required>
                                <option value="">Select Country</option>
                                @foreach (\App\Models\Country::orderBy('name','asc')->get() as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-input-label for="state-name" value="State Name" />
                            <x-text-input id="state-name" type="text" class="mt-1 block w-full"
                                wire:model.defer="newState.name" placeholder="State Name" required autofocus />
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button type="submit" class="ml-2">
                        Add State
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </x-dashboard.container>
</div>
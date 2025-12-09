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
                    </div>
                </x-slot>
                <x-slot name="content">
                    List of states for the selected country.
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <div class="flex items-center mb-4">
                    <x-select wire:model.live="country" class="mr-4">
                        <option value="">Select Country</option>
                        @foreach (\App\Models\Country::orderBy('name','asc')->get() as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach

                    </x-select>
                    <input type="text" wire:model.live="search" placeholder="Search States..."
                        class="input input-bordered w-full" />
                </div>
                <div class="">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>
                                    <!-- Actions -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $state)
                            <tr>
                                <td>
                                    <span class="px-2"> {{$loop->iteration}} </span>
                                </td>
                                <td>
                                    {{ $state['id'] }}
                                </td>
                                <td>

                                    <input type="text" class="input input-bordered w-full"
                                        value="{{ $state['name'] }}" />

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
                                            wire:click="updateState({{ $state['id'] }}, $event.target.previousElementSibling.value)">
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
    </x-dashboard.container>
</div>
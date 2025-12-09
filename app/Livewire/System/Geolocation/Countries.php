<?php

namespace App\Livewire\System\Geolocation;

use App\Models\country;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.app')]
class Countries extends Component
{
    public $searchTerm, $newCountryName, $newCountryCode, $newCountryPhoneCode;
    public $countries = [];

    public function createCountry()
    {
        // create a new country
        if (!country::where('name', $this->newCountryName)->exists()) {
            country::create(
                [
                    'name' => $this->newCountryName,
                    'code' => '',
                    'phonecode' => '',
                ]
            );
        }
    }

    public function updateCountry(country $country, $arrayId)
    {
        $country->update(
            [
                'name' => $this->countries[$arrayId]['name'],
                'code' => $this->countries[$arrayId]['code'],
                'phonecode' => $this->countries[$arrayId]['phonecode'],
            ],
        );
    }

    public function deleteCountry(country $country)
    {
        if ($country->exists()) {
            $country->delete();
            $this->dispatch('success', 'Deleted');
        }
    }

    public function render()
    {
        $q = country::query()->with('states');
        if ($this->searchTerm) {
            $q->where('name', 'like', "%" . $this->searchTerm . "%");
        };
        $this->countries = $q->orderBy('name', 'desc')->get()->toArray();
        return view(

            'livewire.system.geolocation.countries'
        );
    }
}

<?php

namespace App;

use App\Models\city;
use App\Models\country;
use App\Models\state;

trait countryStateCity
{
    public $countries = [];
    public $cities = [];
    public $states = [];
    public $areas = [];
    public $country, $state, $city, $area;

    protected function getCountry()
    {
        $this->countries = country::all();
    }

    protected function getState()
    {
        if (isset($this->country)) {
            $this->states = state::where('country_id', country::where('name', $this->country)->first()?->id)->get();
        } else {
            return [];
        }
    }

    protected function getCity()
    {
        if (isset($this->state)) {
            $this->cities = city::where("state_id", state::where('name', $this->state)->first()?->id)->get();
        } else {
            return [];
        }
    }

    protected function getArea() {}
}

<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\ta;
use Livewire\Attributes\Url;


#[layout('layouts.user.dash.userDash')]
class Edit extends Component
{
    #[URL]
    public $state, $city, $area;
    public function render()
    {
        $city = [];
        $area = [];
        if ($this->state_name) {
            $city = city::where('state_id', state::where('name', $this->state_name)->first()?->id)->get();
        }
        if ($this->city_name) {
            $area = ta::where('city_id', city::where('name', $this->city_name)->first()?->id)->get();
        }
        return view('livewire.profile.edit', [
            'states' => state::where('country_id', country::where('name', 'Bangladesh')->first()?->id)->get(),
            'cities' => $city,
            'area' => $area,
        ]);
    }
}

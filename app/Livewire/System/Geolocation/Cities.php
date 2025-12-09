<?php

namespace App\Livewire\System\Geolocation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\city;
use App\Models\state;
use Illuminate\Support\Facades\Artisan;

#[layout('layouts.app')]
class Cities extends Component
{
    #[URL]
    public $country, $state_id;
    public $newCity = ['state_id' => 0, 'name' => ''], $cities, $state;

    protected $listeners = ['refresh' => '$refresh'];

    public function updated()
    {
        $this->newCity['state_id'] = $this->state_id;
    }

    public function saveCity()
    {
        try {
            $this->validate([
                'newCity.state_id' => 'required|exists:states,id',
                'newCity.name' => 'required|string|max:255',
            ]);
            city::create($this->newCity);

            // reset the form
            $this->dispatch('refresh');
            $this->reset('newCity');
            $this->dispatch('close-modal', 'newCityModal');
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('error', 'Error Adding City: ' . $th->getMessage());
        }
    }

    public function deleteCity($cityId)
    {
        try {
            //code...
            $city = city::findOrFail($cityId);
            $city->delete();
            $this->dispatch('refresh');
            $this->dispatch('success', 'City Deleted');
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('error', 'Error Deleting City: ' . $th->getMessage());
        }
    }

    public function render()
    {
        $cq = city::query();
        $this->state = state::where(['country_id' => $this->country])->orderBy('name', 'asc')->get();

        $cq->where(['state_id' => $this->state_id]);
        $this->cities = $cq->orderBy('name', 'asc')->get();
        return view('livewire.system.geolocation.cities');
    }
}

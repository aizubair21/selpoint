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
    public $country = '18', $state_id, $city_name;

    protected $listeners = ['refresh' => '$refresh'];
    public function saveCity()
    {
        try {

            //code...
            // add new city
            $this->validate([
                'state_id' => 'required|exists:states,id',
                'city_name' => 'required|string|max:255',
            ]);
            city::create([
                'state_id' => $this->state_id,
                'name' => $this->city_name,
            ]);

            // reset the form
            $this->dispatch('refresh');
            $this->reset(['city_name']);
            $this->dispatch('success', 'City Added');
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
        $sq = state::where(['country_id' => $this->country])->get();

        $cq->where(['state_id' => $this->state_id]);

        return view('livewire.system.geolocation.cities', [
            'cities' => $cq->get(),
            'state' => $sq,
        ]);
    }
}

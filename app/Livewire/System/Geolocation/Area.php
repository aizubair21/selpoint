<?php

namespace App\Livewire\System\Geolocation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\city;
use App\Models\state;
use App\Models\ta;
use Illuminate\Support\Str;

#[layout('layouts.app')]
class Area extends Component
{
    #[URL]
    public $country = '18', $state_id, $city_name, $city_id, $area_name;

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

    public function newArea()
    {
        try {

            //code...
            // add new city
            $this->validate([
                'city_id' => 'required',
                'area_name' => 'required|string|max:255',
            ]);
            ta::create([
                'city_id' => $this->city_id,
                'name' => $this->area_name,
                'slug' => Str::slug($this->area_name)
            ]);

            // reset the form
            $this->dispatch('refresh');
            $this->reset(['area_name']);
            $this->dispatch('success', 'Area Added');
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('error', 'Error Adding Area: ' . $th->getMessage());
        }
    }

    public function deleteCity($cityId)
    {
        try {
            //code...
            $city = ta::findOrFail($cityId);
            $city->delete();
            $this->dispatch('refresh');
            $this->dispatch('success', 'Area Deleted');
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


        return view('livewire.system.geolocation.area', [
            'cities' => $cq->get(),
            'state' => $sq,
            'area' => ta::where(['city_id' => $this->city_id])->get(),
        ]);
    }
}

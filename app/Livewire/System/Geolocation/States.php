<?php

namespace App\Livewire\System\Geolocation;

use App\Models\state;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class States extends Component
{
    #[URL]
    public $country;
    public $search, $states = [], $newState = ["name" => "", "country_id" => 0];

    public function addState()
    {
        if (isset($this->newState['name']) && isset($this->newState['country_id'])) {
            state::create(
                [
                    'name' => $this->newState['name'],
                    'country_id' => $this->newState['country_id'],
                ]
            );
            $this->reset('newState');
            $this->dispatch('close-modal', 'add-state-modal');
        } else {
            $this->dispatch('error', 'Error !');
        }
    }

    public function updateState(state $state, $arrayId)
    {
        if (array_key_exists($arrayId, $this->states)) {
            # code...
            $state->update(
                [
                    'name' => $this->states[$arrayId]['name'],
                    'country_id' => $this->states[$arrayId]['country_id'],
                ]
            );

            $this->dispatch('success', 'Updated !');
        }
    }

    public function deleteState(State $state)
    {
        if ($state->exists()) {
            $state->delete();
            $this->dispatch('success', 'Deleted !');
        }
    }

    public function render()
    {
        $q = state::query();

        if (isset($this->country)) {
            $q->where('country_id', $this->country);
        }
        if (isset($this->search)) {
            $q->where('name', 'like', "%" . $this->search . "%");
        }

        $this->states = $q->orderBy('name', 'asc')->get()->toArray();
        return view('livewire.system.geolocation.states');
    }
}

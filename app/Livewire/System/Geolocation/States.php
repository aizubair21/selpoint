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
    public $search, $states = [];

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

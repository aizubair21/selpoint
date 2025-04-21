<?php

namespace App\Livewire\System\Riders;

use App\Models\rider;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Edit extends Component
{
    #[URL]
    public $id, $nav = 'user';
    private $data;

    public $rider;


    public function mount()
    {

        $this->rider = rider::find($this->id);
    }


    public function render()
    {
        return view('livewire.system.riders.edit');
    }
}

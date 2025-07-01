<?php

namespace App\Livewire\System\Comissions;

use App\Models\TakeComissions;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.app')]
class Takes extends Component
{
    public $query_for = 'order_id', $id, $takes = [];

    public function check()
    {
        dd('check');
        if (isset($this->order_id)) {
            $this->takes = TakeComissions::query()->where([$this->query_for => $this->order_id])->get();
        }
    }


    public function render()
    {


        return view('livewire.system.comissions.takes');
    }
}

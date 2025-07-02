<?php

namespace App\Livewire\System\Comissions;

use App\Models\TakeComissions;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Takes extends Component
{
    #[URL]
    public $query_for = 'order_id', $qry = '', $start_date, $end_date, $ord = false;
    public $takes = [];

    public function mount()
    {
        // $this->takes = TakeComissions::query()->where([$this->query_for => $this->qry])->whereBetween('created_at', )->get();
        $this->end_date = today();
        $this->start_date = today()->subDays(30);
        $this->check();
    }

    public function updated()
    {
        $this->check();
    }



    public function check()
    {
        // dd('check');
        if (isset($this->qry)) {
            $this->takes = TakeComissions::query()->where([$this->query_for => $this->qry])->whereBetween('created_at', [$this->start_date, $this->end_date])->orderBy('id', 'desc')->get();
        }
    }


    public function render()
    {


        return view('livewire.system.comissions.takes');
    }
}

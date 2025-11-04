<?php

namespace App\Livewire\System\Comissions;

use App\Models\TakeComissions;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;

#[layout('layouts.print')]
class Takes extends Component
{
    #[URL]
    public $where, $to, $from, $wid;

    public function mount()
    {
        // $this->takes = TakeComissions::query()->where([$this->where => $this->wid])->whereBetween('created_at', )->get();
        // $this->edate = today();
        // $this->sdate = today()->subDays(30);
        // $this->check();
    }

    

    // public function updated()
    // {
    //     $this->check();
    // }



    // public function check() {}


    public function render()
    {

        $query = TakeComissions::query()->when($this->where == 'user_id', function ($query) {
            return $query->where('user_id', $this->wid);
        })
            ->when($this->where == 'product_id', function ($query) {
                return $query->where('product_id', $this->wid);
            })
            ->when($this->where == 'order_id', function ($query) {
                return $query->where('order_id', $this->wid);
            })
            ->when($this->from, function ($query) {
                return $query->whereDate('created_at', '>=', $this->from);
            })
            ->when($this->to, function ($query) {
                return $query->whereDate('created_at', '<=', $this->to);
            })
            ->when($this->wid && $this->where == '', function ($query) {
                return $query->where('id', $this->wid);
            });

        return view('livewire.system.comissions.takes', ['comissions' => $query->get()]);
    }
}

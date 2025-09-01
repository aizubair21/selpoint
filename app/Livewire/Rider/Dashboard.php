<?php

namespace App\Livewire\Rider;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Order;
use Livewire\Attributes\Url;


#[layout('layouts.app')]
class Dashboard extends Component
{
    #[URL]
    public $search;
    public $orders = [], $riderInfo = [];

    public function mount()
    {
        if (auth()->user()?->requestsToBeRider() && auth()->user()?->isRider()) {
            $this->riderInfo = auth()->user()?->isRider();
        }

        // get the order those are match with active user rider info
        if ($this->riderInfo) {
            $this->orders = Order::query()->where(['delevery' => 'cash'])->where(function ($q) {
                $q->where('district', 'like', "%" . $this->search ?? $this->riderInfo->targeted_area . "%")
                    ->orWhere('location', 'like', "%" . $this->search ?? $this->riderInfo->targeted_area . "%")
                    ->orWhere('upozila', 'like', "%" . $this->search ?? $this->riderInfo->targeted_area . "%");
            })->pending()->get();
            // dd($this->orders);
        }
    }
    public function render()
    {
        return view('livewire.rider.dashboard');
    }
}

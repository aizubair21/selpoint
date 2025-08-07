<?php

namespace App\Livewire\System\Store;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Index extends Component
{

    #[URL]
    public $nav = 'store', $type = 'withdraw';
    // $query = request('get') ?? "store";
    // $type = request('type') ?? 'withdraw';


    public function render()
    {
        // $track = AdminCoinStoreTracking::query();
        // switch ($this->nav) {
        //     case 'store':
        //         $track = $track->store();
        //         break;

        //     case 'donation':
        //         $track = $track->donation();
        //         break;

        //     case 'cost':
        //         $track = $track->cost();
        //         break;
        // }
        // $strack = $track->whereDate('created_at', today())->orderBy('created_at', 'desc')->get();
        $strack = [];
        return view('livewire.system.store.index', compact('strack'));
    }
}

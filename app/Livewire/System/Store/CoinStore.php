<?php

namespace App\Livewire\System\Store;

use App\Models\Store;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CoinStore extends Component
{
    public $ammount;

    public function addAmmountToStore()
    {
        try {
            //code...
            if ($this->ammount > 1) {
                DB::transaction(function () {
                    $user = Store::query()->store()->first();
                    $user->coin += $this->ammount;
                    $user->save();
                });
                $this->dispatch('refresh');
                $this->dispatch('open-modal', 'add-store-coin');
                // reset(['ammount']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            abort(500, $th->getMessage());
        }
    }


    public function render()
    {
        $store = Store::query()->store()->first();
        // $withdraw_trac = $tracking->withdraw()->store()->get();
        // $diposit_track = $tracking->deposit()->store()->get();
        return view('livewire.system.store.coin-store', compact('store'));
    }
}

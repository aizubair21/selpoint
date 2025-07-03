<?php

namespace App\Livewire\User\Wallet;

use App\Models\DistributeComissions;
use App\Models\TakeComissions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.user.dash.userDash')]
class Comission extends Component
{
    use WithPagination;
    #[URL]
    public $nav = 'earn';
    public function render()
    {
        $data = [];
        if ($this->nav == 'system') {
            $data = TakeComissions::where(['user_id' => Auth::id(), 'confirmed' => true])->paginate(100);
        } else {
            $data = DistributeComissions::where(['user_id' => Auth::id(), 'confirmed' => true])->paginate(100);
        }
        return view('livewire.user.wallet.comission', compact('data'));
    }
}

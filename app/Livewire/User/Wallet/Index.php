<?php

namespace App\Livewire\User\Wallet;

use App\Models\User;
use App\Models\user_task;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
class Index extends Component
{
    public $task, $comission, $reffer, $withdraw;

    public function mount()
    {
        $this->withdraw = Withdraw::where(['user_id' => Auth::id(), 'status' => 'Pending'])->latest()->get();
    }

    public function render()
    {
        $this->task = user_task::where(['user_id' => Auth::id()])->whereDate('created_at', '=', today())->first();
        // $this->comission = ;
        return view('livewire.user.wallet.index');
    }
}

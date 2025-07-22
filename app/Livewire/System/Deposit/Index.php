<?php

namespace App\Livewire\System\Deposit;

use App\Models\userDeposit;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\Url;


#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $status = false;


    public function confirmDeposit($id)
    {
        $dp = userDeposit::findOrFail($id);
        $dp->user?->increment('coin', $dp->amount);
        $dp->confirmed = true;
        $dp->save();
        $this->dispatch('success', "User recharged successfully!");
        // dd($dp);
        $this->dispatch('refresh');
    }
    public function denayDeposit($id)
    {
        $dp = userDeposit::destroy($id);
        $this->dispatch('refresh');
        // $dp = userDeposit::findOrFail($id);
    }


    public function render()
    {
        $history = userDeposit::where(['confirmed' => $this->status])->orderBy('id', 'desc')->paginate(config('app.config'));
        return view('livewire.system.deposit.index', compact('history'));
    }
}

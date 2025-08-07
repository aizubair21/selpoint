<?php

namespace App\Livewire\System\Withdraw;

use App\Models\Withdraw;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $user = null, $fst = 'Pending';
    public function render()
    {
        $qry = Withdraw::query();
        if ($this->fst == 'Reject') {
            $qry->where(['is_rejected' => true]);
        } else {
            $sts = $this->fst == 'Accept' ? 1 : 0;
            $qry->where(['status' => $sts, 'is_rejected' => false]);
        }
        $withdraw = $qry->orderBy('id', 'desc')->paginate(config('app.pagination'));
        return view('livewire.system.withdraw.index', compact('withdraw'));
    }
}

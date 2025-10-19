<?php

namespace App\Livewire\System\Withdraw;

use App\Models\Withdraw;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $user = null, $fst = 'Pending', $sdate, $edate;
    public $total, $pending, $reject, $paid;

    public function getWithdraw()
    {
        $q = Withdraw::query();
        $this->total = $q->count();
        $this->pending = withdraw::pending()->count();
        $this->paid = withdraw::accepted()->count();
        $this->reject = withdraw::rejected()->count();
        $this->edate = today();
    }
    public function render()
    {
        $qry = Withdraw::query();
        if ($this->fst == 'Reject') {
            $qry->rejected();
        };

        if ($this->fst != 'Reject') {
            $sts = $this->fst == 'Accept' ? 1 : 0;
            $qry->where(['status' => $sts]);
        }

        $qry->whereBetween('created_at', [$this->sdate, Carbon::parse($this->edate)->endOfDay()]);

        $withdraw = $qry->orderBy('id', 'desc')->paginate(config('app.pagination'));
        // dd($withdraw);
        return view('livewire.system.withdraw.index', compact('withdraw'));
    }
}

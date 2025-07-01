<?php

namespace App\Livewire\System\Comissions;

use App\Models\DistributeComissions;
use App\Models\TakeComissions;
use Livewire\Component;
use Livewire\Attributes\Layout;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;

#[layout('layouts.app')]
class Index extends Component
{
    public $pc = 0, $pcc = 0, $ps = 0, $pg = 0, $cc = 0, $ccc = 0, $profit = 0, $take = 0, $give = 0, $store = 0, $return = 0, $tgen = 0, $ttake = 0, $tgive = 0, $tstore = 0, $treturn = 0, $today;
    public $seller = 0, $product = 0, $order = 0, $todaysTakeComissions = [];
    public function mount()
    {
        // $this->getData();
        // $this->todaysTakeComissions = TakeComissions::query()
        //     ->whereDate('created_at', now()->yesterday())
        //     ->groupBy('order_id', 'take_comission', 'distribute_comission', 'store', 'return', 'confirmed', 'created_at')
        //     ->select('order_id', 'take_comission', 'distribute_comission', 'store', 'return', 'confirmed', 'created_at')
        //     ->get();


        $this->todaysTakeComissions = TakeComissions::query()->get();
    }

    public function getData()
    {
        // dd($this->todaysTakeComissions);\


        $this->pc = TakeComissions::query()->pending()->count();
        $this->pcc = TakeComissions::query()->pending()->sum('take_comission');
        $this->pg = TakeComissions::query()->pending()->sum('distribute_comission');
        $this->ps = TakeComissions::query()->pending()->sum('store');
        $this->cc = TakeComissions::query()->confirmed()->count();
        $this->ccc = TakeComissions::query()->confirmed()->sum('take_comission');


        // confirmed
        $confirmed =  TakeComissions::query()->confirmed();
        $this->give = $confirmed->sum('distribute_comission');
        $this->store = $confirmed->sum('store');
        $this->return = $confirmed->sum('return');
        $this->profit = TakeComissions::query()->sum('profit');


        // todays
        $todays = TakeComissions::query()->whereDate('created_at', today());
        $this->tgen = $todays->sum('profit');
        $this->ttake = $todays->sum('take_comission');
        $this->tgive = $todays->sum('distribute_comission');
        $this->tstore = $todays->sum('store');
        $this->treturn = $todays->sum('return');


        // 
        $this->seller = TakeComissions::groupBy('user_id')->count();
        $this->product = TakeComissions::groupBy('product_id')->count();
        $this->order = TakeComissions::groupBy('order_id')->count();
    }





    public function render()
    {
        return view('livewire.system.comissions.index');
    }
}

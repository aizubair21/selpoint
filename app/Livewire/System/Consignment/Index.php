<?php

namespace App\Livewire\System\Consignment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\cod;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

#[layout('layouts.app')]
class Index extends Component
{
    #[URL]
    public $type = 'Pending', $sdate, $edate;

    use WithPagination;

    public function mount()
    {
        $this->sdate = now()->format('Y-m-d');
        $this->edate = now()->format('Y-m-d');
    }
    public function render()
    {
        $query = cod::query();

        if ($this->type != 'All') {
            # code...
            $query->where(['status' => $this->type]);
        }
        $query->whereBetween('created_at', [$this->sdate, carbon::parse($this->edate)->endOfDay()]);

        $cod = $query->orderBy('id', 'desc')->paginate(30);
        return view('livewire.system.consignment.index', compact('cod'));
    }
}

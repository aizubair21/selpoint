<?php

namespace App\Livewire\System\Vip;

use App\Models\vip;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[layout('layouts.app')]
class Users extends Component
{
    use WithPagination;
    #[URL]
    public $nav = 'Pending', $search = '';

    // public $vip;

    // public function mount()
    // {
    //     $this->vip = vip::where(['status' => $this->nav == 'Pending' ? 0 : 1])->get();
    // }

    public function render()
    {
        $vip = vip::where(['status' => $this->nav == 'Pending' ? 0 : 1])->paginate(config('app.paginate'));
        if ($this->nav == 'Trash') {
            $vip = vip::onlyTrashed()->paginate(config('app.paginate'));
            // dd($vip);
        }
        return view('livewire.system.vip.users', compact('vip'));
    }
}

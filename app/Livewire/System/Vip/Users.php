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

    public function render()
    {
        $st = false;
        if ($this->nav !== 'Pending') {
            $st = true;
        } else {
            $st = false;
        }

        if ($this->nav == 'Trash') {
            $vip = vip::onlyTrashed()->paginate(config('app.paginate'));
        } else {
            $vip = vip::query()->where(['status' => $st])->paginate(config('app.paginate'));
        }

        if (isset($this->search) && !empty($this->search)) {
            $vip = vip::where('name', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->paginate(config('app.paginate'));
        }

        return view('livewire.system.vip.users', compact('vip'));
    }
}

<?php

namespace App\Livewire\System\Vip;

use App\Models\Packages;
use App\Models\vip;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Edit extends Component
{

    #[URL]
    public $vip,  $nav = 'document';

    public $vipData, $vips;

    public function mount()
    {
        $this->vipData = vip::withTrashed()->find($this->vip);
        // dd($this->vip->);
        $this->vips = Packages::all();
    }


    public function updateStatusToActive()
    {
        if ($this->vipData->deleted_at) {
            $this->dispatch('warning', 'Trashed !');
        } else {

            $this->vipData->status = 1;
            $this->vipData->save();
        }
        $this->dispatch('refresh');
    }

    public function updateStatusToPending()
    {
        if ($this->vipData->deleted_at) {
            $this->dispatch('warning', 'Trashed !');
        } else {

            $this->vipData->status = 0;
            $this->vipData->save();
            $this->dispatch('refresh');
        }
    }

    public function updateStatusToReject()
    {
        if ($this->vipData->deleted_at) {
            $this->dispatch('warning', 'Trashed !');
        } else {

            $this->vipData->status = -1;
            $this->vipData->delete();
            $this->redirectIntended(route('system.vip.users'), true);
        }
    }

    public function restore()
    {
        $this->vipData->restore();
        $this->dispatch('success', 'Succfully restored !');
    }


    public function delete()
    {
        $this->vipData->forceDelete();
        $this->redirectIntended(route('system.vip.users'), true);
    }

    public function render()
    {
        return view('livewire.system.vip.edit');
    }
}

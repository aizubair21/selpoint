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
    public $vip, $nav = 'document';

    public $vipData, $vips, $vlid_days = 360, $task = 'daily', $package;

    public function mount()
    {
        $this->vipData = vip::withTrashed()->find($this->vip);
        // dd($this->vipData->package_id);
        $this->vips = Packages::all();


        // assigne task
        $this->task = $this->vipData->task_type;
        $this->package = $this->vipData->package_id;
        // dd($this->task);
    }

    // package updated
    public function updatePackage()
    {
        // 
    }

    // update task
    public function updateTask()
    {
        try {
            //code...
            $this->vipData->task_type = $this->task;
            $this->vipData->save();
            $this->dispatch('success', 'Task Type Updated !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // update validity
    public function updateValidity()
    {
        try {
            //code...
            $this->vipData->valid_from = now();
            $this->vipData->valid_till = now()->addDays($this->vlid_days);
            $this->vipData->save();
            $this->dispatch('success', 'Validation Updated!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateStatusToActive()
    {
        try {
            //code...
            if ($this->vipData->deleted_at) {
                $this->dispatch('warning', 'Trashed !');
            } else {

                $this->vipData->status = 1;
                if (empty($this->vipData->valid_till)) {
                    $this->vipData->valid_from = now();
                    $this->vipData->valid_till = now()->addDays($this->vlid_days);
                }
                $this->vipData->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
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

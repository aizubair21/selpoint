<?php

namespace App\Livewire\System\Resellers;

use App\Models\reseller;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;

class Edit extends Component
{
    #[URL]
    public $id, $filter, $nav = 'documents';

    public $resellers, $deatline, $requestStatus;

    // mount 
    public function mount()
    {
        $this->getData();
        if (!$this->resellers?->id) {
            $this->redirectIntended(route("system.reseller.index", ['filter' => $this->filter]), true);
        }
    }


    public function getData()
    {
        $this->resellers = reseller::find($this->id);
    }

    /**
     * update deatline
     */
    public function updateDeatline()
    {
        $this->resellers?->documents?->update(['deatline' => $this->deatline]);
        $this->dispatch('alert', 'Updated');
        $this->getData();
    }

    public function updateStatus()
    {
        $this->resellers->status = $this->requestStatus;
        $this->resellers->save();


        $this->dispatch('success', "Status Updated !");
        $this->dispatch('refresh');
    }


    public function render()
    {
        return view('livewire.system.resellers.edit')->layout('layouts.app');
    }
}

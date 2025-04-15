<?php

namespace App\Livewire\User\Upgrade\Vendor;

use App\Models\vendor;
use Livewire\Component;
use Livewire\Attributes\Url;

class Edit extends Component
{
    #[URL]
    public $id;


    /**
     * component data
     */
    public $data;

    public function mount()
    {
        $this->data = vendor::find($this->id);
    }


    public function render()
    {
        return view('livewire.user.upgrade.vendor.edit')->layout('layouts.user.dash.userDash');
    }
}

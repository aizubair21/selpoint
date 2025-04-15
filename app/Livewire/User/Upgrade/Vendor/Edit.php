<?php

namespace App\Livewire\User\Upgrade\Vendor;

use App\Models\vendor;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Url;

class Edit extends Component
{
    #[URL]
    public $id, $nav;

    private $data;

    // listeners for refresh event 
    protected $listener = ['refresh' => 'refresh'];


    /**
     * component data
     */
    public $vendor;


    public function mount()
    {
        $this->data = vendor::find($this->id);
        $this->vendor = $this->data->toArray();
    }


    public function update()
    {
        // 
        // dd(request()->all());
        vendor::find($this->id)->update($this->vendor);
        // Session::flash('success', 'Your vendor request updated !');
        $this->dispatch('refresh');
        $this->dispatch('alert', 'Updated');
    }


    public function render()
    {
        return view('livewire.user.upgrade.vendor.edit')->layout('layouts.user.dash.userDash');
    }
}

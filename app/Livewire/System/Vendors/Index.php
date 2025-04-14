<?php

namespace App\Livewire\System\Vendors;

use Livewire\Component;
use App\Models\vendor;

class Index extends Component
{
    public $vendors;

    /**mount */
    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {
        $this->vendors = vendor::where(['status' => 'Pending'])->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        $vendors = vendor::where(['status' => 'Pending'])->orderBy('id', 'desc')->get();
        return view('livewire.system.vendors.index', ['vendors' => $vendors])->layout('layouts.app');
    }
}

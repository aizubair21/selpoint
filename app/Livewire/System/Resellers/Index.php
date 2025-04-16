<?php

namespace App\Livewire\System\Resellers;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Reactive;
use App\Models\vendor;

class Index extends Component
{
    #[URL]
    public $filter = 'Active', $find;

    public $resellers;

    public function mount()
    {
        //    
    }


    public function getDate() {}


    /**
     * search vendor 
     */
    public function search()
    {
        if ($this->filter == "*") {
            $this->resellers = vendor::where('shop_name_en', 'like', '%' . $this->find . '%')->get();
        } else {
            $this->resellers = vendor::where('shop_name_en', 'like', '%' . $this->find . '%')->where(['status' => $this->filter])->get();
        }
    }

    public function render()
    {
        return view('livewire.system.resellers.index')->layout('layouts.app');
    }
}

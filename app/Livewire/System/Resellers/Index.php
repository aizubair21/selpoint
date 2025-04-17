<?php

namespace App\Livewire\System\Resellers;

use App\Models\reseller;
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
        $this->getData();
    }


    public function getData()
    {
        $this->resellers = reseller::where(['status' => $this->filter])->get();
    }


    /**
     * search vendor 
     */
    public function search()
    {
        if ($this->filter == "*") {
            $this->resellers = reseller::where('shop_name_en', 'like', '%' . $this->find . '%')->get();
        } else {
            $this->resellers = reseller::where('shop_name_en', 'like', '%' . $this->find . '%')->where(['status' => $this->filter])->get();
        }
    }

    public function render()
    {
        return view('livewire.system.resellers.index')->layout('layouts.app');
    }
}

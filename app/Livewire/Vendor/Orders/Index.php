<?php

namespace App\Livewire\Vendor\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithPagination;


#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    #[URL]
    public $nav = 'Pending';

    public $otme, $account;

    public function mount()
    {
        $this->getData();
        $this->account = auth()->user()->account_type();
    }


    public function getData()
    {
        // $this->otme = auth()->user()->orderToMe()->where(['belongs_to_type' => $this->account]);
    }


    public function render()
    {

        if ($this->nav == 'Trashed') {
            $data = auth()->user()->orderToMe()->where(['belongs_to_type' => $this->account])->orderBy('id', 'desc')->onlyTrashed();
        } else {
            $data = auth()->user()->orderToMe()->where(['status' => $this->nav, 'belongs_to_type' => $this->account])->orderBy('id', 'desc')->paginate(20);
        }
        return view('livewire.vendor.orders.index', compact('data'));
    }
}

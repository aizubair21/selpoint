<?php

namespace App\Livewire\User\Vip\Package;

use App\Models\Packages;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;

#[layout('layouts.user.dash.userDash')]
class Checkout extends Component
{
    #[URL]
    public $id;
    public $package, $ownerPackage;

    #[validate('required')]
    public $payment_by, $trx, $name, $phone, $task_type, $nid, $nid_front, $nid_back;

    public function mount()
    {
        $this->package = Packages::find($this->id);
        $this->ownerPackage = 1;
    }

    public function purchase()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.user.vip.package.checkout');
    }
}

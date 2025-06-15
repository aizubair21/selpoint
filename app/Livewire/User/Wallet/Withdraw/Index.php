<?php

namespace App\Livewire\User\Wallet\Withdraw;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[layout('layouts.user.dash.userDash')]
class Index extends Component
{
    #[validate('required')]
    public $pay_to, $pay_by, $amount;
    public function render()
    {
        $withdraw = [];
        return view('livewire.user.wallet.withdraw.index', compact('withdraw'));
    }

    public function requestPayment()
    {
        $this->validate(
            [
                'pay_to' => 'required',
                'pay_by' => 'required',
                'amount' => 'required',
            ],
            [
                'pay_to.required' => 'Give A Payment Number.',
                'pay_by.required' => 'Select A payment Method.',
                'amount.required' => 'Give Amount .'
            ]
        );
    }
}

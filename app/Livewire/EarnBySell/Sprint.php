<?php

namespace App\Livewire\EarnBySell;

use Livewire\Component;
use App\Models\CartOrder;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

#[layout('layouts.print')]
class Sprint extends Component
{
    #[url]
    public $nav = 'sold', $fd, $lastDate, $user_type = 'user', $account;
    public $totalSell, $tp, $tn, $tpr, $tprr, $shop, $ushop;


    public function render()
    {
        $q = CartOrder::query()->where('belongs_to_type', $this->account);

        $q->where(function ($q) {

            if ($this->nav == 'sold') {
                $q->where('status', 'Confirm');
            } elseif ($this->nav == 'selling') {
                $q->whereIn('status', ['Pending', 'Picked', 'Delivery', 'Delivered', 'Cancel', 'Hold', 'Cancelled']);
            }
        })->whereBetween('created_at', [$this->fd, Carbon::parse($this->lastDate)->endOfDay()]);

        $products = $q->orderBy('id', 'desc')->get();
        return view(
            'livewire.earn-by-sell.sprint',
            [
                'products' => $products
            ]
        );
    }
}

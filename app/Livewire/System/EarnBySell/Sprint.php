<?php

namespace App\Livewire\System\EarnBySell;

use Livewire\Component;
use App\Models\CartOrder;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;


#[layout('layouts.print')]
class Sprint extends Component
{
    #[url]
    public $nav = 'sold', $fd, $lastDate, $user_type = 'user';
    public $totalSell, $tp, $tn, $tpr, $tprr, $shop, $ushop;



    public function render()
    {
        $q = CartOrder::query();

        $q->where(function ($q) {
            if ($this->user_type != 'all') {
                $q->where('user_type', $this->user_type);
            }
            if ($this->nav == 'sold') {
                $q->where('status', 'Confirm');
            } elseif ($this->nav == 'selling') {
                $q->whereIn('status', ['Pending', 'Picked', 'Delivery', 'Delivered', 'Cancel', 'Hold', 'Cancelled']);
            }
        })->whereBetween('created_at', [$this->fd, Carbon::parse($this->lastDate)->endOfDay()]);

        $products = $q->orderBy('id', 'desc')->get();
        return view(
            'livewire.system.earn-by-sell.sprint',
            [
                'products' => $products
            ]
        );
    }
}

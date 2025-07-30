<?php

namespace App\Livewire\Vendor\Orders;

use App\Http\Controllers\ProductComissionController;
use App\Models\CartOrder;
use App\Models\Order;
use App\Models\syncOrder;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;


#[layout('layouts.app')]
class View extends Component
{
    #[URL]
    public $order;

    public $orders, $mainProduct, $isResell = false, $resellerProductId = '', $cartOrderId = '';
    public $district, $upozila, $location, $area_condition, $delevery, $quantity, $rprice, $attr, $name, $phone, $house_no, $road_no;

    public function mount()
    {
        $this->orders = Order::find($this->order);
    }

    public function computed() {}


    public function updateStatus($status)
    {
        // dd($this->orders);
        if ($this->orders->status == 'Pending') {

            if (auth()->user()->abailCoin() > $this->orders->comissionsInfo->sum('take_comission')) {

                $this->orders->status = $status;
                $this->orders->save();

                $ct = new ProductComissionController(); // instance
                $ct->confirmTakeComissions($this->orders->id); // call to confirm comissions 

                $this->dispatch('refresh');
            } else {
                $this->dispatch('warning', "You Don't have requried balance to accept the order. You need ensure minimum" . $this->orders->comissionsInfo->sum('take_comission') . " balance to procces the order ");
            }
        }

        // if ($this->orders->status == 'Accept') {
        //     $pcc = new ProductComissionController();
        //     $pcc->confirmTakeComissions($this->order->id);
        // }
    }

    public function syncOrder($ci)
    {
        $cartOrderQuery = CartOrder::findOrFail($ci);

        if ($cartOrderQuery->product?->isResel) {
            $this->isResell = true;
            $this->resellerProductId = $cartOrderQuery->product_id;
            $this->mainProduct = $cartOrderQuery->product?->isResel?->mainProduct;
            $this->cartOrderId = $cartOrderQuery->id;
        }

        // dd($this->mainProduct);

        $this->district = $this->orders->district;
        $this->upozila = $this->orders->upozila;
        $this->location = $this->orders->location;
        $this->area_condition = $this->orders->area_condition;
        $this->delevery = $this->orders->delevery;
        $this->rprice = $ci->price;
        $this->quantity = $ci->quantity;
        $this->attr = $ci->size;
        $this->name = $this->orders->user?->name;
        $this->phone = $this->orders->number ?? $this->orders->user?->phone;
        $this->house_no = $this->orders->house_no;
        $this->road_no = $this->orders->road_no;
        $this->dispatch('open-modal', 'order-sync-modal');
    }

    public function confirmSyncOrder()
    {
        // $isExists = Order::where(
        //     [
        //         'order_id' => $this->orders->id,
        //         'user_id' => auth()->user()->id,
        //         'user_type' => 'reseller',
        //         'belongs_to' => $this->mainProduct->user_id,
        //         'belongs_to_type' => 'vendor',
        //     ]
        // )->exists();

        $order = order::create(
            [
                'user_id' => auth()->user()->id,
                'user_type' => 'reseller',
                'belongs_to' => $this->mainProduct->user_id,
                'belongs_to_type' => 'vendor',

                'quantity' => $this->quantity,
                'total' => $this->quantity * $this->rprice,
                'status' => 'Pending',

                'name' => $this->name,
                'district' => $this->district,
                'upozila' => $this->upozila,
                'location' => $this->location,
                'house_no' => $this->house_no,
                'road_no' => $this->road_no,
                'area_condition' => $this->area_condition,
                'delevery' => $this->delevery,
                'number' => $this->phone,
                'shipping' => $this->area_condition == 'Dhaka' ? 80 : 120,
            ]
        );

        $cor = CartOrder::create(
            [
                'user_id' => Auth::id(),
                'user_type' => 'reseller',
                'belongs_to' => $this->mainProduct->user_id,
                'belongs_to_type' => 'vendor',
                'order_id' => $order->id,
                'product_id' => $this->mainProduct->id,
                'quantity' => $this->quantity,
                'price' => $this->rprice,
                'size' => $this->attr,
                'total' => $this->quantity * $this->rprice,
                'buying_price' => $this->mainProduct->offer_type ? $this->mainProduct->discount : $this->mainProduct->price,
                'status' => 'Pending',
            ]
        );


        $this->dispatch('refresh');
        $this->dispatch('success', 'Order Done');

        if ($order->id && $cor->id) {
            # code...
            ProductComissionController::dispatchProductComissionsListeners($order->id);
        }

        $this->dispatch('close-modal', 'order-sync-modal');

        $sync = new syncOrder();
        
        $sync->user_id = $this->orders->user_id;
        $sync->user_order_id = $this->orders->id;
        $sync->user_cart_order_id = $this->cartOrderId;
        $sync->reseller_product_id = $this->resellerProductId;
        $sync->reseller_order_id = $order->id;
        $sync->vendor_product_id = $this->mainProduct->id;
        $sync->reseller_id = auth()->user()->id;
        $sync->vendor_id = $this->mainProduct->belongs_to;

        $this->mainProduct->$sync->save();
    }

    public function render()
    {
        return view('livewire.vendor.orders.view');
    }
}

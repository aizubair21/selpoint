<?php

namespace App\Livewire\Vendor\Orders;

use App\Http\Controllers\ProductComissionController;
use App\Models\CartOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\syncOrder;
use App\Models\TakeComissions;
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

    public $orderStatus = 'Pending', $orders, $mainProduct, $isResell = false, $resellerProductId = '', $cartOrderId = '', $cartOrder;
    public $district, $upozila, $location, $area_condition, $delevery, $quantity, $rprice, $attr, $name, $phone, $house_no, $road_no;

    public function mount()
    {
        $this->orders = Order::find($this->order);
        $this->orderStatus = $this->orders->status;
    }

    // public function updated($property)
    // {
    //     // if orderStatus update
    //     $this->updateStatus($this->orders); // update status
    // }

    // public function updateOrderStatusTo($status)
    // {
    //     $this->updateStatus($status);
    // }


    public function updateOrderStatusTo($status)
    {
        // dd($status);
        $sysOr = syncOrder::where(['reseller_order_id' => $this->orders->id])->first();
        // dd($sysOr->userOrder);
        if (in_array($status, ['Cancel', 'Hold', 'Pending'])) {
            $this->orders->update(['status' => $status]);
            if ($sysOr) {
                # code...
                $sysOr->status = $status;
                $sysOr->save();
            }
        }

        if ($this->orders->status == 'Pending' && auth()->user()->abailCoin() < $this->orders->comissionsInfo->sum('take_comission')) {
            $this->dispatch('warning', "You Don't have required balance to accept the order. You need ensure minimum" . $this->orders->comissionsInfo->sum('take_comission') . " balance to procces the order ");
            return;
        }

        if (auth()->user()->abailCoin() > $this->orders->comissionsInfo->sum('take_comission')) {

            $this->orders->update(['status' => $status]);
            // $this->orders->save();

            if ($sysOr) {
                # code...
                $sysOr->status = $status;
                $sysOr->save();
            }

            if ($this->orders->status == 'Confirm') {
                $ct = new ProductComissionController(); // instance
                $ct->confirmTakeComissions($this->orders->id); // call to confirm comissions 
                // $ct->confirmTakeComissions($sysOr->user_order_id); // call to confirm comissions for user

                // $comisionForUser = TakeComissions::where([
                //     'order_id' => $this->cartOrder->order_id,
                //     'product_id' => $this->cartOrder->product_id,
                // ])->get();

                // if ($comisionForUser->count() > 0) {
                //     # code...
                //     $comisionForUser->each(function ($item) {
                //         $item->confirmed = true;
                //         // You could add more custom logic here
                //         $item->save();
                //     });
                // }
            }

            $this->dispatch('refresh');
            return;
        } else {
            $this->dispatch('warning', "You Don't have required balance to accept the order. You need ensure minimum" . $this->orders->comissionsInfo->sum('take_comission ') . " balance to procces the order ");
            return;
        }

        // if ($this->orders->status == 'Accept') {
        //     $pcc = new ProductComissionController();
        //     $pcc->confirmTakeComissions($this->order->id);
        // }
    }

    public function syncOrder($ci)
    {
        $this->cartOrder = CartOrder::findOrFail($ci);

        if ($this->cartOrder->product?->isResel()) {
            $this->isResell = true;
            $this->resellerProductId = $this->cartOrder->product_id;
            $this->mainProduct = $this->cartOrder->product?->isResel;
            $this->cartOrderId = $this->cartOrder->id;
        }

        // $comisionForUser = TakeComissions::where([
        //     'order_id' => $this->cartOrder->order_id,
        //     'product_id' => $this->cartOrder->product_id,
        // ])->get();

        // dd($comisionForUser);

        // dd($this->mainProduct);

        $this->district = $this->orders->district;
        $this->upozila = $this->orders->upozila;
        $this->location = $this->orders->location;
        $this->area_condition = $this->orders->area_condition;
        $this->delevery = $this->orders->delevery;
        $this->rprice = $this->cartOrder->price;
        $this->quantity = $this->cartOrder->quantity;
        $this->attr = $this->cartOrder->size;
        $this->name = $this->orders->user?->name;
        $this->phone = $this->orders->number ?? $this->orders->user?->phone;
        $this->house_no = $this->orders->house_no;
        $this->road_no = $this->orders->road_no;
        $this->dispatch('open-modal', 'order-sync-modal');
    }

    public function confirmSyncOrder()
    {
        // dd($this->mainProduct?->id,);
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
                'belongs_to' => $this->cartOrder?->product?->isResel?->belongs_to,
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
                'belongs_to' => intval($this->cartOrder?->product?->isResel?->user_id),
                'belongs_to_type' => 'vendor',
                'order_id' => $order->id,
                'product_id' => $this->mainProduct?->parent_id,
                'quantity' => $this->quantity,
                'price' => $this->rprice,
                'size' => $this->attr,
                'total' => $this->quantity * $this->rprice,
                'buying_price' => Product::find($this->mainProduct?->product_id)->buying_price,
                'status' => 'Pending',
            ]
        );


        $this->dispatch('refresh');
        $this->dispatch('success', 'Order Done');

        if ($order->id && $cor->id) {
            # code...
            ProductComissionController::dispatchProductComissionsListeners($order->id);
        }

        $sync = new syncOrder();
        $sync->user_id = $this->orders->user_id;
        $sync->user_order_id = $this->orders->id;
        $sync->user_cart_order_id = $this->cartOrderId;
        $sync->reseller_product_id = $this->resellerProductId;
        $sync->reseller_order_id = $order->id;
        $sync->vendor_product_id = $this->mainProduct->id;
        $sync->reseller_id = auth()->user()->id;
        $sync->vendor_id = $this->cartOrder?->product?->isResel?->belongs_to;
        $sync->status = 'Pending';

        $sync->save();

        $this->dispatch('close-modal', 'order-sync-modal');
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.vendor.orders.view');
    }
}

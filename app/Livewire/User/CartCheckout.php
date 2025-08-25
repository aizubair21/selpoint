<?php

namespace App\Livewire\User;

use App\Events\ProductComissions;
use App\Http\Controllers\ProductComissionController;
use App\Models\cart;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Order;
use App\Models\CartOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;

#[layout('layouts.user.dash.userDash')]
class CartCheckout extends Component
{
    public $carts = [], $qty = [], $tp = 0, $q = 0, $isMultiple, $selectedCarts;

    #[validate('required')]
    public $phone, $house_no, $road_no, $location, $area_condition = 'Dhaka', $district, $upozila, $shipping = 0, $delevery;

    #[On('refresh')]
    public function mount()
    {
        // dd(cart::where(['user_id' => auth()->user()->id])->get()->groupBy('belongs_to')->toArray());
        // dd(auth()->user()->myCarts()->first()->product->attr);
        // dd(auth()->user()->myCarts()->first()->product->attr);
        $this->carts = auth()->user()->myCarts->toArray();
        $this->tp = 0;
        $this->q = 0;
        foreach ($this->carts as $key => $cart) {
            $p = $cart['qty'] * $cart['price'];
            $this->q += $cart['qty'];
            $this->tp += $p;
        }

        if (auth()->user()->myCarts->count() < 1) {
            $this->redirectIntended('/', true);
        }

        // dd($this->carts);
    }

    // public function updated($property)
    // {
    //     if ($property == $this->area_condition) {
    //         $this->shipping = $this->area_condition == 'Dhaka' ? 80 : 120;
    //     }
    // }


    public function updated()
    {
        if ($this->delevery == 'hand') {
            $this->shipping = 0;
        }
    }

    public function changeSize($id)
    {
        // dd($id);
        auth()->user()->myCarts()->find($id)->size = $this->cart[$id]['size'];
    }


    public function increaseQuantity($cartId)
    {
        auth()->user()->myCarts()->find($cartId)->increment('qty');
        auth()->user()->myCarts()->find($cartId)->save();
        $this->dispatch('refresh');
    }
    public function decreaseQuantity($cartId)
    {
        if (auth()->user()->myCarts()->find($cartId)->qty == 1) {
            auth()->user()->myCarts()->find($cartId)->delete();
        } else {

            auth()->user()->myCarts()->find($cartId)->decrement('qty');
            auth()->user()->myCarts()->find($cartId)->save();
        }
        $this->dispatch('refresh');
        // dd($this->carts[0]);
        // $this->carts->find($cartId)->update(['qty' => $qty]);
    }


    public function confirm()
    {
        $this->validate();

        try {

            $ct = cart::where(['user_id' => auth()->user()->id])->get()->groupBy('belongs_to'); // get all cart group by belongs_to
            foreach ($ct as $reseller => $rp) {
                // iterated by single reseller
                $qty = 0;
                $total = 0;
                $order = 0;

                // $order = Order::create(
                //     [
                //         ]
                //         'user_id' => auth()->user()->id,
                //         'user_type' => 'user',
                //         'belongs_to' => $reseller,
                //         'belongs_to_type' => 'reseller',
                //         'status' => 'Pending',
                //         // 'product_id' => $this->product?->id,
                //         'size' => 'Details',
                //         'name' => 'Cart Order',
                //         // 'price' => $this->tp,
                //         // 'quantity' => $rp->sum('qty'),
                //         // 'total' => $this->tp,
                //         // 'buying_price' => $this->product?->buying_price,
                //         'delevery' => $this->delevery,
                //         'number' => $this->phone,
                //         'area_condition' => $this->area_condition,
                //         'district' => $this->district,
                //         'upozila' => $this->upozila,
                //         'location' => $this->location,
                //         'phone' => $this->phone,
                //         'road_no' => $this->road_no,
                //         'house_no' => $this->house_no,
                //         'shipping' => $this->area_condition == 'Dhaka' ? 80 : 120,
                // );
                $order = new Order();
                $order->user_id = auth()->user()->id;
                $order->user_type = 'user';
                $order->belongs_to = $reseller;
                $order->belongs_to_type = 'reseller';
                $order->status = 'Pending';
                // $order->/ 'product_id = $this->product?->id;
                $order->size = 'Details';
                $order->name = 'Cart Order';
                // $order->/ 'price = $this->tp;
                // $order->/ 'quantity = $rp->sum('qty');
                // $order->/ 'total = $this->tp;
                // $order->/ 'buying_price = $this->product?->buying_price;
                $order->delevery = $this->delevery;
                $order->number = $this->phone;
                $order->area_condition = $this->area_condition;
                $order->district = $this->district;
                $order->upozila = $this->upozila;
                $order->location = $this->location;
                $order->phone = $this->phone;
                $order->road_no = $this->road_no;
                $order->house_no = $this->house_no;
                $order->shipping = $this->area_condition == 'Dhaka' ? 80 : 120;
                $order->save();



                foreach ($rp as $key => $item) {
                    $qty += $item->qty;
                    $total += $item->price * $item->qty;

                    CartOrder::create(
                        [
                            'user_id' => auth()->user()->id,
                            'user_type' => 'user',
                            'belongs_to' => $item->product?->user_id,
                            'belongs_to_type' => 'reseller',
                            'order_id' => $order->id,
                            'product_id' => $item->product->id,
                            'size' => $item->size,
                            'price' => $item->price,
                            'total' => $item->price * $item->qty,
                            'quantity' => $item->qty,
                            'buying_price' => $item->product?->buying_price ?? '0',
                        ]
                    );

                    auth()->user()->myCarts()->delete($item->id);
                }

                Order::find($order->id)->update(
                    [
                        'quantity' => $qty,
                        'total' => $total,
                    ]
                );

                // dispatch comissions
                ProductComissionController::dispatchProductComissionsListeners($order->id);
            }
        } catch (\Throwable $th) {
            $this->dispatch('error', $th->getMessage());
        }




        // $this->reset('name', 'phone', 'location', 'district');
        $this->redirectRoute('user.orders.view');
        $this->dispatch('refresh');
        $this->dispatch('success', "Product added to order list");
    }



    public function render()
    {
        return view('livewire.user.cart-checkout');
    }
}

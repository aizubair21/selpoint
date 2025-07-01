<?php

namespace App\Livewire\Pages;

use App\Events\ProductComissions;
use App\Http\Controllers\ProductComissionController;
use App\Models\cart;
use App\Models\CartOrder;
use App\Models\Order;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;

#[layout('layouts.user.app')]
class SingleProductOrder extends Component
{
    #[URL]
    public $slug;

    public $product, $size, $total, $price;

    #[validate('required')]
    public $location, $phone, $quantity = 1, $house_no, $road_no, $area_condition = 'Dhaka', $district, $upozila, $shipping = 80, $delevery = 'Courier';

    public function updated($property)
    {
        if ($property) {
            $this->total = $this->price * $this->quantity;
            $this->shipping = $this->area_condition == 'Dhaka' ? 80 : 120;;
        }
    }


    public function mount()
    {
        // dd($this->slug);
        $this->product = Product::where(['slug' => $this->slug, 'status' => 'active', 'belongs_to_type' => 'reseller'])->first();
        $this->price = $this->product?->offer_type ? $this->product?->discount : $this->product?->price;
        $this->total = $this->price;
        // if (!$this->product) {
        //     return redirect('/');
        // }
    }

    public function confirm()
    {
        // ProductComissions::dispatch(6);
        $this->validate();

        if (auth()->user()->id !== $this->product->user_id) {

            try {
                //code...
                $order = Order::create(
                    [
                        'user_id' => auth()->user()->id,
                        'user_type' => 'user',
                        'belongs_to' => $this->product?->user_id,
                        'belongs_to_type' => 'reseller',
                        'status' => 'Pending',
                        // 'product_id' => $this->product?->id,
                        // 'size' => $this->size ?? 'Free Size',
                        // 'name' => $this->name,
                        // 'price' => $this->price,
                        'quantity' => $this->quantity,
                        'total' => $this->total,
                        'delevery' => $this->delevery,
                        'number' => $this->phone,
                        'area_condition' => $this->area_condition,
                        'district' => $this->district,
                        'upozila' => $this->upozila,
                        'location' => $this->location,
                        'phone' => $this->phone,
                        'road_no' => $this->road_no,
                        'house_no' => $this->house_no,
                        'shipping' => $this->shipping,
                        // 'buying_price' => $this->product?->buying_price,
                    ]
                );

                CartOrder::create(
                    [
                        'user_id' => auth()->user()->id,
                        'user_type' => 'user',
                        'belongs_to' => $this->product?->user_id,
                        'belongs_to_type' => 'reseller',
                        'order_id' => $order->id,
                        'product_id' => $this->product->id,
                        'size' => $this->size,
                        'price' => $this->price,
                        'total' => $this->total,
                        'quantity' => $this->quantity,
                        'buying_price' => $this->product?->buying_price ?? '0',
                    ]
                );
                $this->redirectRoute("user.orders.view");

                // dispatch comissions
                // ProductComissions::dispatch($order->id);

                ProductComissionController::dispatchProductComissionsListeners($order->id);
            } catch (\Throwable $th) {
                $this->dispatch('error', $th->getMessage());
            }
        } else {
            $this->dispatch('warning', "You can't purchase your own product");
        }
    }


    public function render()
    {
        return view('livewire.pages.single-product-order');
    }
}

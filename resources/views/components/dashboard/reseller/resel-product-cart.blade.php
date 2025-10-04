<?php 

use Livewire\Volt\Component;
use Livewire\Attributes\URL;
use App\Models\Reseller_like_product;
use App\Models\Reseller_resel_product;
use App\Models\Reseller_has_order;
use App\Models\Reseller_order_details;
use App\Models\Order;
use App\Models\CartOrder;

use App\Http\Controllers\ProductComissionController;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;


new class extends Component 
{
    public $pd, $alreadyLiked = false, $discountPercent, $haveDiscount = false, $resellerOrderId = '', $needToSync = false, $myOrder = '';

    #[validate('required')]
    public $district, $upozila, $location, $area_condition, $delevery, $quantity, $rprice, $attr, $name, $phone, $house_no, $road_no;

    public function mount() 
    {
        // dd($this->pd);
        if ($this->pd->offer_type) {
            $this->haveDiscount = true;
            $dis = $this->pd->price - $this->pd->discount;
            // make discount percent
            $this->discountPercent = ($dis / $this->pd->price) * 100;
        }
        // check this product alreay in liked list of reseller    
        $this->alreadyLiked = Reseller_like_product::where(['user_id' => auth()->user()->id, 'product_id' => $this->pd->id])->exists();
    }
    

    public function like ()
    {
        if ($this->alreadyLiked) {
            Reseller_like_product::where(['user_id' => auth()->user()->id, 'product_id' => $this->pd->id])->delete();
            // $this->dispatch('refresh');
            $this->alreadyLiked = false;
            // $this->dispatch('success', 'Product removed from your favourite list');
        }else{

            Reseller_like_product::create(
                [
                    'user_id' => auth()->user()->id,
                    'product_id' => $this->pd->id,
                ]
            );
            $this->alreadyLiked = true;
            // $this->dispatch('refresh');
            // $this->dispatch('success', 'Product added to your favourite list');
        }

    }


    public function order()     
    {
        $this->validate();
        try {
            //code...
            $order = order::create(
                [
                    'user_id' => auth()->user()->id,
                    'user_type' => 'reseller',
                    'belongs_to' => $this->pd->user_id,
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
                    'belongs_to' => $this->pd->user_id,
                    'belongs_to_type' => 'vendor',
                    'order_id' => $order->id,
                    'product_id' => $this->pd->id,
                    'quantity' => $this->quantity,
                    'price' => $this->rprice,
                    'size' => $this->attr,
                    'total' => $this->quantity * $this->rprice,
                    'buying_price' => $this->pd->offer_type ? $this->pd->discount : $this->pd->price,
                    'status' => 'Pending',
                ]
            );
            
            
            $this->dispatch('refresh');
            $this->dispatch('success', 'Order Done');

            if ($order->id && $cor->id) {
                # code...
                ProductComissionController::dispatchProductComissionsListeners($order->id);
            }
   
        } catch (\Throwable $th) {
            throw $th;
            $this->dispatch('info', 'Have an Error');
        }
    }

    public function takeOrderInfoAndFill(){
        
        $this->myOrder = auth()->user()->orderToMe()->where('id', $this->resellerOrderId)->get();
        // if this->myOrder is empty, then make an input validation error
        if (empty($this->resellerOrderId)) {
            $this->addError('resellerOrderId', 'Requied !');
        }
        
        if ($this->myOrder->count() < 1) {
            $this->addError('resellerOrderId', 'No Order found !');
        }
        if($this->myOrder->count() > 0){
            $this->needToSync = true;
            $this->district = $this->myOrder[0]->district;
            $this->upozila = $this->myOrder[0]->upozila;
            $this->location = $this->myOrder[0]->location;
            $this->area_condition = $this->myOrder[0]->area_condition;
            $this->delevery = $this->myOrder[0]->delevery;
            $this->name = $this->myOrder[0]->user?->name;
            $this->phone = $this->myOrder[0]->number ?? $this->myOrder[0]->user?->phone;
            $this->house_no = $this->myOrder[0]->house_no;
            $this->road_no = $this->myOrder[0]->road_no;
        }
    }

    public function resetFindOrder()
    {
        $this->reset('resellerOrderId');
        $this->needToSync = false;
        $this->district = '';
        $this->upozila = '';
        $this->location = '';
        $this->area_condition = '';
        $this->delevery = '';
        $this->name = '';
        $this->phone = '';
        $this->house_no = '';
        $this->road_no = '';

    }
}

?>


<div>
    <div class="bg-white rounded shadow overflow-hidden relative">

        @if ($pd->offer_type)

        <div class="absolute top-0 left-0 px-2 bg-indigo-900 text-white rounded text-sm ">
            @php
            $dis = $pd->price - $pd->discount;
            @endphp
            {{ round(($dis / $pd->price) * 100, 1) ?? 0}}% off
        </div>
        @endif

        <div class="h-[120px] overflow-hidden shadow-md p-1">
            <img src="{{asset('storage/'. $pd->thumbnail)}}" alt="image">
        </div>
        <div class="p-2 bg-white">
            <x-nav-link href="{{route('reseller.resel-product.veiw', ['pd' => $pd->id])}}">
                <div class="text-sm">{{$pd->name ?? "N/A"}}</div>
            </x-nav-link>

            <div class="text-md">
                @if ($pd->offer_type)
                <div class="bold">
                    {{$pd->discount ?? "0"}} TK
                </div>
                <div class="text-xs">
                    <del>
                        {{$pd->price ?? "0"}} TK
                    </del>
                </div>
                @else
                <div class="bold">
                    {{$pd->price ?? "0"}} TK
                </div>
                @endif
            </div>
            {{-- <div class="text-right">
                <button>clone</button>
            </div> --}}
            <x-hr />
            <div class="flex justify-center items-center text-sm">
                <x-nav-link-btn class=" text-center"
                    x-on:click.prevent="$dispatch('open-modal', 'orderProduct_{{$pd->id}}')"> Purchase <i
                        class="fas fa-angle-right pl-2"></i> </x-nav-link-b>
                    {{-- <button>To Cart</button> --}}
            </div>
        </div>

        {{-- <i class="fa-thin fa-thumbs-up"></i> --}}
        @volt('pd')
        <button wire:click="like"
            class="absolute top-0 right-0 w-8 h-8 rounded-full shadow flex justify-center items-center bg-gray-100">
            <i wire:show="!alreadyLiked" wire:transition class="fa-regular fa-heart"> </i>
            <i wire:show="alreadyLiked" wire:transition class="fa-solid fa-heart"> </i>
        </button>
        @endvolt
        {{-- <i class="fa-thin fa-circle-check"></i> --}}
    </div>

    <x-modal name="orderProduct_{{$pd->id}}" maxWidth="md">
        <div class="p-3 bold border-b">
            Purchase
        </div>
        @volt('order')
        <div class="p-5">

            {{-- <form wire:submit.prevent="takeOrderInfoAndFill" class="bg-gray-100 p-2 rounded">
                <x-input-field inputClass="w-full" type="number" class="md:flex" label="Order ID"
                    wire:model.live="resellerOrderId" name="resellerOrderId" error="resellerOrderId" />
                <div class="text-end flex justify-end gap-3">
                    <x-secondary-button type="button" wire:click.prevent="resetFindOrder">Reset</x-secondary-button>
                    <x-primary-button>Attach</x-primary-button>
                </div>
            </form> --}}

            <form wire:submit.prevent="order">
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Name" wire:model.live="name"
                    name="name" error="name" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Phone" wire:model.live="phone"
                    name="phone" error="phone" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer District" wire:model.live="district"
                    name="district" error="district" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Upozila" wire:model.live="upozila"
                    name="upozila" error="upozila" />
                <x-input-field inputClass="w-full" label="Customer Full Address" name="location"
                    wire:model.live="location" error="location" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Road No" name="road_no"
                    wire:model.live="road_no" error="house_no" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer House No" name="house_no"
                    wire:model.live="house_no" error="house_no" />
                <x-hr />
                <div class="text-xs">
                    Original Price : {{$this->pd->price}}
                </div>
                <x-input-field inputClass="w-full" class="md:flex" label="Reseller Price  " wire:model.live="rprice"
                    name="rprice" error="rprice" />

                <div class="text-xs" wire:show='rprice'>
                    Profit: <strong> {{$this->rprice - $this->pd->price}} </strong>
                </div>

                <x-hr />
                <x-input-field inputClass="w-full" class="md:flex" label="Product Quantity" wire:model.live="quantity"
                    name="quantity" error="quantity" />
                <x-input-field inputClass="w-full" class="md:flex" label="Product Size/Attribute" wire:model.live="attr"
                    name="attr" error="attr" />
                <x-hr />
                <x-input-file label="Area Condition" error='area_condition'>
                    <select wire:model.live="area_condition" id="">
                        <option value="">Select Area</option>
                        <option value="Dhaka">Inside Dhaka</option>
                        <option value="Other">Out side of Dhaka</option>
                    </select>
                </x-input-file>
                <x-input-file label="Delevery Method" name="delevery" error="delevery">
                    <select wire:model.live="delevery" id="">
                        <option value="">Select Shipping Type</option>
                        <option value="Courier">Courier</option>
                        <option value="Home">Home Delevery</option>
                    </select>
                </x-input-file>
                <x-primary-button>Order</x-primary-button>
            </form>
        </div>
        @endvolt
    </x-modal>
</div>
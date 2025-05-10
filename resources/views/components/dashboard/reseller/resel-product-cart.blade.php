

<?php 

use Livewire\Volt\Component;
use Livewire\Attributes\URL;
use App\Models\Reseller_like_product;
use App\Models\Reseller_resel_product;
use App\Models\Reseller_has_order;
use App\Models\Reseller_order_details;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;


new class extends Component 
{
    public $pd, $alreadyLiked = false;
    #[validate('required')]
    public $district, $upozila, $location, $area_condition, $delevery, $quantity, $rprice, $attr, $note, $name, $phone, $house_no, $road_no;

    public function mount() 
    {
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
        DB::transaction(function () {
            
            $order = Reseller_has_order::create(
                [
                    'user_id' => auth()->user()->id,
                    'belongs_to' => $this->pd->user_id,
                    'quantity' => $this->quantity,
                    'total' => $this->quantity * $this->rprice,
                    'status' => 'Pending',
    
                    'district' => $this->district,
                    'upozila' => $this->upozila,
                    'location' => $this->location,
                    'house_no' => $this->house_no,
                    'road_no' => $this->road_no,
                    'area_condition' => $this->area_condition,
                    'delevery' => $this->delevery,
                    'note' => $this->note,
                ]
            );
    
            Reseller_order_details::create(
                [
                    'order_id' => $order->id,
                    'belongs_to' => $this->pd->user_id,
                    'product_id' => $this->pd->id,
                    'reseller_price' => $this->rprice,
                    'original_price' => $this->pd->price,
                    'quantity' => $this->quantity,
                    'total' => $this->quantity * $this->rprice,
                    'attr' => $this->attr,
                ]
            );


            $this->dispatch('refresh');
            $this->dispatch('success', 'Order Done');
        });
        $this->dispatch('info', 'Have an Error. Try again');
    }
}

?>


<div>
    <div class="bg-white rounded shadow overflow-hidden relative">
        <div class="h-[150px] overflow-hidden shadow-md p-1">
            <img src="{{asset('storage/'. $pd->thumbnail)}}" alt="image">
        </div>
        <div class="p-2 bg-white">
            <x-nav-link href="{{route('reseller.resel-product.veiw', ['pd' => $pd->id])}}" >
                <div class="text-sm">{{$pd->title ?? "N/A"}}</div>
            </x-nav-link>
            <div class="text-md bold">
                {{$pd->price ?? "0"}} TK
            </div>
            {{-- <div class="text-right">
                <button>clone</button>
            </div> --}}
            <x-hr/>
            <div class="flex justify-between items-center text-sm">
                <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'orderProduct_{{$pd->id}}')">Resel</x-primary-button>
                {{-- <button>To Cart</button> --}}
            </div>
        </div>

        {{-- <i class="fa-thin fa-thumbs-up"></i> --}}
        @volt('pd')
            <button wire:click="like" class="absolute top-0 right-0 w-8 h-8 rounded-full shadow flex justify-center items-center bg-gray-100">
                <i wire:show="!alreadyLiked" wire:transition class="fa-regular fa-heart"> </i>
                <i wire:show="alreadyLiked" wire:transition class="fa-solid fa-heart"> </i>
            </button>
        @endvolt
        {{-- <i class="fa-thin fa-circle-check"></i> --}}
    </div>

    <x-modal name="orderProduct_{{$pd->id}}" maxWidth="md" >
        <div class="p-3 bold border-b">
            Reseller Order Product
        </div>
        @volt('order')
        <div class="p-5">
            <form wire:submit.prevent="order" >
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Name" wire:model.live="name" name="name" error="name" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Phone" wire:model.live="phone" name="phone" error="phone" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer District" wire:model.live="district" name="district" error="district" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Upozila" wire:model.live="upozila" name="upozila" error="upozila" />
                <x-input-field inputClass="w-full" label="Customer Full Address" name="location" wire:model.live="location" error="location" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Road No" name="road_no" wire:model.live="road_no" error="house_no" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer House No" name="house_no" wire:model.live="house_no" error="house_no" />
                <x-hr/>
                <div class="text-xs">
                    Original Price : {{$this->pd->price}}
                </div>
                <x-input-field inputClass="w-full" class="md:flex" label="Reseller Price  " wire:model.live="rprice" name="rprice" error="rprice" />
            
                <div class="text-xs" wire:show='rprice'>
                    Profit: <strong> {{$this->rprice - $this->pd->price}} </strong>
                </div>

                <x-hr/>
                <x-input-field inputClass="w-full" class="md:flex" label="Product Quantity" wire:model.live="quantity" name="quantity" error="quantity" />
                <x-input-field inputClass="w-full" class="md:flex" label="Product Attr" wire:model.live="attr" name="attr" error="attr" />
                <x-input-field inputClass="w-full" label="Reseller Note" name="note" wire:model.live="note" error="note" />
                <x-hr/>
                <x-input-file label="Area Condition" name="area_condition" error='area_condition'>
                    <select wire:model.live="area_condition" id="" >
                        <option value="Dhaka">Inside Dhaka</option>
                        <option value="Other">Out side of Dhaka</option>
                    </select>
                </x-input-file>
                <x-input-file label="Delevery Method" name="delevery" error="delevery" >
                    <select wire:model.live="delevery" id="" >
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


<?php 

use Livewire\Volt\Component;
use Livewire\Attributes\URL;


new class extends Component 
{
    public $pd, $district, $upozila, $location, $quantity, $rprice, $name, $phone, $delevary, $alreadyLiked = false;

    public function mount() 
    {
        // check this product alreay in liked list of reseller    
    }
    

    public function like ()
    {
        dd($this->pd->id);
    }


    public function order()     
    {

    }
}

?>


<div>
    <div class="bg-white rounded shadow overflow-hidden relative">
        <div class="h-[100px] shadow-md p-1">
            <img height="100px" src="{{asset('storage/'. $pd->thumbnail)}}" alt="image">
        </div>
        <div class="p-2">
            <x-nav-link href="" >
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
                <i  class="fa-regular fa-heart"> </i>
            </button>
        @endvolt
        {{-- <i class="fa-thin fa-circle-check"></i> --}}
    </div>

    <x-modal name="orderProduct_{{$pd->id}}" maxWidth="md" >
        <div class="p-3 bold border-b">
            Reseller Order Product
        </div>
        <div class="p-5">
            <form wire:submit.prevent="order" >
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Name" name="name" error="name" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Phone" name="phone" error="phone" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer District" name="district" error="district" />
                <x-input-field inputClass="w-full" class="md:flex" label="Customer Upozila" name="pozila" error="pozila" />
                <x-input-field inputClass="w-full" label="Customer Full Address" name="location" error="location" />
                <x-hr/>
                <x-input-field inputClass="w-full" class="md:flex" label="Reseller Price" name="price" error="price" />
                <x-hr/>
                <x-input-field inputClass="w-full" class="md:flex" label="Product Quantity" name="quantity" error="quantity" />
                <x-hr/>
                <x-primary-button>Order</x-primary-button>
            </form>
        </div>
    </x-modal>
</div>
<?php 

use Livewire\Volt\Component;
use Livewire\Attributes\URL;
use App\Models\cart;


new class extends Component
{
    #[URL]
    public $product, $isAuthProductower = false;

    public function mount() 
    {
        $this->isAuthProductower = $this->product->user_id == Auth::user()?->id ? true : false;    
    }
    
    
    public function addToCart()
    {

        if (Auth::guest()) {
            $this->dispatch('warning', 'Login to add Cart');
        } else {

            $isAlreadyInCart = auth()->user()->myCarts()->where(['product_id' => $this->product->id])->exists();
            if ($isAlreadyInCart) {
                $this->dispatch('info', 'Product already in cart');
            } else {
                cart::create(
                    [
                        'product_id' => $this->product?->id,
                        'name' => $this->product?->title,
                        'image' => $this->product?->thumbnail,
                        'price' => $this->product?->offer_type ? $this->product?->discount : $this->product?->price,
                        'user_id' => auth()->user()->id,
                        'user_type' => 'user',
                        'belongs_to' => $this->product?->user_id,
                        'belongs_to_type' => 'reseller',
                        'qty' => 1,
                    ]
                );

                $count = auth()->user()->myCarts()->count();
                // dd($isAlreadyInCart);
                $this->dispatch('cart', $count);
                $this->dispatch('success', 'Product Added to cart');
            }
        }
    }
}

?>

<div>
@props(['product'])

<div class="lg:flex justify-between item-start p-2">
    <!-- card left -->
    <div class="w-full lg:w-1/2 ">
        <div class="img-display">
            <div class="img-showcase">
                <img id="preview" class=" p-2 rounded" style="width: 100%; object-fit:contain; max-width:400px; height:300px" height="400" src="{{ asset('storage/' . $product?->thumbnail) }}"alt="image">
            </div>

            @if ($product->showcase)
                <div class="d-flex align-items-center" style="flex-wrap: wrap">
                    <button class="p-1 rounded mb-1">
                        <img class=" border p-1 rounded" onclick="previewImage(this)" src="{{asset('storage/'. $product?->thumbnail)}}" width="45px" height="45px" alt="">
                    </button>
                    @foreach ($product->showcase as $images)
                        <button class="p-1 rounded mb-1">
                            <img width="45px" height="45px"  class=" border p-1 rounded" onclick="previewImage(this)" src="{{asset('storage/'. $images?->image)}}" width="45px" height="45px" alt="">
                        </button>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <div class="w-full lg:w-1/2 py-3 lg:py-0 lg:px-0">
        <div>
            {{-- Shop  --}}
            <div class="text-green-900 w-auto text-xs">
                Shop : 
                <strong>
                    {{$product?->owner?->resellerShop()->shop_name_en ?? "N/A"}}
                </strong>
            </div>
            <div style="font-size: 28px; font-weight:bold;">{{$product->title}}</div>
            <div class="flex justify-between items-center py-2 border-x" style="font-size: 14px">
                
                <div class="flex items-center">
                    <i class="text_primary fas fa-star"></i>
                    <i class="text_primary fas fa-star"></i>
                    <i class="text_primary fas fa-star"></i>
                    <i style="color: #737272" class=" fas fa-star"></i>
                    <i style="color: #737272" class=" fas fa-star"></i>
                    <div class="px-1" style="color: #737272">
                        7/10
                    </div>
                </div>
                
                <div class="cursor-pointer flex items-center">
                    <i style="color:var(--brand-primary);" class="fas fa-heart mr-2"></i>
                    <div>save for later</div>
                </div>

            </div>
        </div>

        
        {{-- category  --}}
        <div class="pt-3 flex items-center">
            Category:  
            <div class="ps-3 text_primary bold rounded">
                <a wire:navigate href="{{route('category.products' , ['cat' =>$product->category?->name])}}">
                    {{$product->category?->name ?? "Undefined"}}
                </a>
            </div>
        </div>
        
        
        {{-- attr  --}}
        <div class="py-2 my-3 border-y">
            @if ($product->attr?->value)
                <h4> {{ $product->attr?->name }} </h4>
                @php
                    $arrayOfAttr = explode(',', $product->attr?->value);
                @endphp
                <div class="flex justify-start items-center my-1" style="flex-wrap: wrap;gap: 10px;">
                    @foreach ($arrayOfAttr as $attr)
                        <div class="border rounded mr-2 d-none @if($attr) d-block @endif" style="width:45px; height:35px; align-content:center; text-align:center">
                            {{ $attr }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- price  --}}
        <div class="py-3">
            
            @if($product->offer_type)
                <div style="font-size:22px; margin-right:12px"> Price : <strong class="text_secondary bold"> {{$product->discount}} TK  </strong></div>
               

                <div class="" style="font-size: 14px">
                    MRP:
                    <del class="px-1">
                        {{$product->price}} TK
                    </del> / 
                    @php
                        $originalPrice = $product->price;
                        $discountedPrice = $product->discount;
                        $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
                        $isAuthProductower = $product->user_id == auth()->user()->id ? true : false;    
                    @endphp
                    <div >{{ round($discountPercentage, 0) }}% OFF</div>
                </div>
            @else 
                <div style="font-weight:bold;font-size:22px; color:var(--brand-primary); margin-right:12px"> Price : {{$product->price}} TK </div>
            @endif 
           
        </div>
        <x-hr/>
        
        <div class="purchase-info flex justify-evenly items-center w-full" >
            <x-nav-link-btn wire:navigate class="mr-2 rounded px-3 py-1 text-center" href="{{route('product.makeOrder', ['slug' => $product->slug])}}">
                <i class="fas fa-arrow-right mx-2"></i>Buy Now 
            </x-nav-link-btn>
            
            @volt('cartAdd')
                <x-primary-button wire:click="addToCart" type="button" class="option1">
                    <i class="fas fa-cart-plus mx-2"></i> <span class="hidden md:block">To Cart</span>
                </x-primary-button>
            @endvolt
           
        </div>
        {{-- <div class="mt-3 text-center text-xs">
            SHARE WITH YOUR FRIENDS
        </div> --}}
    </div>


    <script>
        function previewImage(element){
            const file = element.src;
            console.log(file);
            document.getElementById('preview').src = file;
            // const reader = new FileReader();
            // reader.onload = () => {
            //     const preview = document.getElementById('preview');
            //     preview.src = reader.result;
            // };
            // reader.readAsDataURL(file);
                
        }
    </script>
</div>
</div>
<?php 

use Livewire\Volt\Component;
use Livewire\Attributes\URL;
use App\Models\cart;


new class extends Component
{
    #[URL]
    public $product;
    
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

    <div class="w-full lg:w-1/2 py-3 lg:py-0 px-4 lg:px-0">
        <div>
            <div class="text_primary bold rounded" style="font-size: 12px">
                {{-- @php
                    $catName = DB::table("categories")->where(['id'=>$product->category_id])->select(['id', 'name'])->first();
                @endphp --}}
                <a wire:navigate href="{{route('category.products' , ['cat' =>$product->category?->name])}}">
                    {{$product->category?->name ?? "Undefined"}}
                </a>
                {{-- {{$catName->id}} --}}

            </div>
            <div style="font-size: 28px; font-weight:bold;">{{$product->title}}</div>
            <div class="flex justify-between items-center" style="font-size: 14px">
                
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
        <hr>
        

        <div class="py-2 my-2">
            {{-- <div style="font-size: 20px; font-weight:bold;">Available Options :</div> --}}
            {{-- <div>
                <div>Size</div>
                <div class="d-flex justify-content-start align-items-center my-1">
                    <div class="border rounded mr-2" style="width:45px; height:35px; align-content:center; text-align:center">S</div>
                    <div class="border rounded mr-2" style="width:45px; height:35px; align-content:center; text-align:center">M</div>
                    <div class="border rounded mr-2" style="width:45px; height:35px; align-content:center; text-align:center">L</div>
                    <div class="border rounded mr-2" style="width:45px; height:35px; align-content:center; text-align:center">XL</div>
                    <div class="border rounded mr-2" style="width:45px; height:35px; align-content:center; text-align:center">XXL</div>
                </div>
            </div> --}}

            @if ($product->attr)
                <h4> {{ $product->attr?->name }} </h4>
                @php
                    //convert the string attr-value to array
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
        <hr>
        <div class="">
            {{-- <div style="font-weight:bold;font-size:17px;">Price : @if($product->price_in_usd != null) ${{$product->price_in_usd}} @else {{$product->price_in_bdt}} tk @endif</div> --}}
            
            @if($product->offer_type)
                <div style="font-size:22px; margin-right:12px"> Price : <strong class="text_secondary bold"> {{$product->discount}} TK  </strong></div>
                {{-- <div style="font-weight:bold;font-size:20px;">
                    Discount Price : 
                        @if($product->price_in_usd != null)                                
                            ${{$product->discount}}
                        @else 
                            {{$product->discount}} tk 
                        @endif    
                </div> --}}

                <div class="" style="font-size: 14px">
                    MRP:
                    <del class="px-1">
                        {{$product->price}} TK
                    </del> / 
                    @php
                        $originalPrice = $product->price;
                        $discountedPrice = $product->discount;
                        $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
                    @endphp
                    <div >{{ round($discountPercentage, 0) }}% OFF</div>
                </div>
            @else 
                <div style="font-weight:bold;font-size:22px; color:var(--brand-primary); margin-right:12px"> Price : {{$product->price}} TK </div>
            @endif 
            {{-- @if($product->offer_type == 'yes' && $product->discount)
            @endif  --}}
        </div>
        <hr>
        <div class="py-1 my-2" style="">Quantity: {{$product->unit}}</div>
        
        <div wire:show="!request()->routeIs('reseller.resel-product.view')" class="purchase-info md:flex justify-start items-center w-full">
            <a wire:navigate type="button" class="sm:mb-2 md:mr-2 rounded px-3 py-1 text-center" href="{{route('product.makeOrder', ['slug' => $product->slug])}}">
                <i class="fas fa-arrow-right mx-2"></i>Buy Now 
            </a>
            
            @volt('cartAdd')
                <x-secondary-button wire:click="addToCart" type="button" class="option1">
                    <i class="fas fa-cart-plus mx-2"></i> To Cart
                </x-secondary-button>
            @endvolt
            {{-- <button type="button" onclick="window.location.href='{{ route('order.single', ['id' => $product->id]) }}'"
                class="btn" style="border-radius: 20px;">
                    Order Now
            </button> --}}
        </div>
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
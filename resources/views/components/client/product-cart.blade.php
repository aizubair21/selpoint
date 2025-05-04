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
        }else{

            $isAlreadyInCart = auth()->user()->myCarts()->exists(['product_id' => $this->product->id]);
            if ($isAlreadyInCart) {
                $this->dispatch('info', 'Product already in cart');
            }else{
                cart::create(
                    [
                        'product_id' => $this->product->id,
                        'user_id' => auth()->user()->id,
                        'user_type' => 'user',
                        'belongs_to' => $this->product->user_id,
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


{{-- @props(['product']) --}}

<div class="box border bg-white">

    
    @if($product->offer_type == 'yes' && $product->discount)
        @php
            $originalPrice = $product->price_in_usd ?? $product->price_in_bdt;
            $discountedPrice = $product->discount;
            $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
            @endphp
        <div class="discount-badge bg_primary" style="z-index:5">{{ round($discountPercentage, 0) }}%</div>
    @endif  
    <div class="option_container hidden lg:block" style="background-color:hsla(24, 100%, 90%, 0.419);; transform:blur(10px)">
        <div class="flex flex-col justify-between items-center" style="height:100%; width:100%">

            <div class="flex flex-col justify-between flex-1">
                
                @volt('cartBtn')
                    <div>
                        <button wire:click="addToCart" class="border-0 p-2 fs-4 bg-transfarent text-center w-100" type="submit">
                            <i class="fas fa-cart-plus mx-2"></i> To Cart
                        </button>
                    </div>
                @endvolt
                
             
                <x-nav-link href="{{route('products.details', ['id' => $product->id, 'slug' => $product->slug])}}" class="text-sm border-0 text-center py-1 text_secondary bold">
                    View Details <i class="fas fa-arrow-right mx-2"></i>
                </x-nav-link>
            </div>
            <x-nav-link class="py-2 text-center bg-white flex items-center justify-center" style="font-weight:bold;color:var(--brand-primary); width:100%" href="{{route('product.makeOrder', ['slug' => $product->slug])}}">
                Order Now <i class="fas fa-arrow-right mx-2"></i>
            </x-nav-link>
        </div>
    </div>
    <a class="d-block" href="">
    
        <div class="img-box">
            <img src="{{ asset('storage/' . $product->thumbnail) }}">
        </div>
    
        {{-- card body  --}}
        <div class="details_box">
            
            <div class="w-full mb-2 flex items-start justify-between text-white" >
    
                {{-- <a href="{{ route('product.details', ['id' => $product->id]) }}" class="d-block w-100 mr-1 px-3 py-1 bold d-block bg_primary border-0 text-start text-light" style="border-top-right-radius:12px; border-bottom-right-radius:12px">
                    {{ $product->name }}
                </a>
    
                <div style="width:20%; border-top-left-radius:12px; border-bottom-left-radius:12px" class="px-2 h-100 bg_primary d-flex justify-content-center align-items-center text-light">
                    {{ $product->unit }} 
                </div> --}}
    
    
                <a href="{{route('products.details', ['id' => $product->id, 'slug' => $product->slug])}}" class="text-sm text-truncate w-100 mr-1 px-3 py-1 bold bg_primary border-0 text-slate-0 product-title">
                    {{ $product->name ?? "N/A"}}
                </a>
    
                <div style="width:20%;" class="text-sm py-1 px-2 bg_primary">
                    {{ $product->unit ?? "N/A"}} 
                </div>
    
            </div>
            
            <div style="height:32px; width:100%; display:flex; flex-direction:row-reverse; align-items: center; font-size:14px; @if($product->offer_type == 'yes')justify-content:space-between @else justify-content:center @endif" class="px-2 py-1">
                @if($product->offer_type == 'yes')
                    
                    <div class="text-md @if($product->offer_type == 'yes') pr-2 @else align-self:center @endif" style="font-weight: bold; text-align:right">
                        {{$product->discount}} TK
                    </div>
    
                    <div>
                        <del>   
                            MRP {{$product->price}} TK    
                        </del>
                    </div>
    
                @else
                    <div class=" test-md @if($product->offer_type == 'yes') pr-2 @else align-self:center @endif" style="font-weight: bold; text-align:right">
                        {{$product->price}} TK
                    </div>
                @endif 
            </div>
            {{-- <div style="font-size: 13px;background-color:var(--brand-light);" class=" px-3 py-1 rounded-pill  d-flex justify-content-center align-items-center">
                <div style="width:10px; height:10px; border-radius:50%; background-color:var(--brand-primary); " class="mr-2"></div>
                {{ $product->unit }}
            </div> --}}
    
            {{-- @guest    
                <a type="button" class=" btn_hover hover_zoom d-block py-2 text-center d-flex align-items-center justify-content-center option1" style="font-weight:bold; color:var(--brand-primary); width:100%" href="{{ route('order.single', ['id' => $product->id]) }}">
                    Order Now <i class="fas fa-arrow-right mx-2"></i>
            
                </a>
        
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="" >
                    @csrf
                    <button class="border-0 p-2 fs-4 bg-none text-center w-100 text-light" type="submit" style="background-color: var(--brand-primary)">
                        <i class="fas fa-cart-plus mx-2"></i> To Cart
                    </button>
        
        
                </form>
                
            @else
            @endguest --}}
            <a type="button" class="text-sm btn_hover hover_zoom d-block py-2 text-center flex items-center justify-center" style="font-weight:bold; color:var(--brand-primary); width:100%" href="{{route('product.makeOrder', ['slug' => $product->slug])}}">
                <i class="fas fa-cart-plus mx-2"></i>Order Now 
            </a>
            {{-- <form action="{{ route('cart.add', $product->id) }}" method="post" class="" >
                @csrf
                <button class="border-0 p-2 bg-white text-center w-100 text_secondary" type="submit">
                    <i class="fas fa-cart-plus mx-2"></i> To Cart
                </button>
    
    
            </form> --}}
            
    
        </div>
    
    </a>
     
    

    
</div>

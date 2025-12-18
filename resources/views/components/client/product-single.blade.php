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

    <div class="lg:flex justify-start item-start">
        <!-- card left -->
        <div class="mr-1" style="width:100%; max-width:600px">
            <div class="img-display sm:flex sm:justify-start items-start lg:block rounded">
                <div class="img-showcase" style="">
                    <img id="preview" class="rounded-md border"
                        style="width: 100%; object-fit:contain; max-width:600px;" height="400"
                        src="{{ asset('storage/' . $product?->thumbnail) }}" alt="image">
                </div>

                @if ($product?->showcase)
                <div class="flex items-center md:block lg:flex flex-wrap">
                    <button class="p-1 rounded mb-1">
                        <img class="p-1 rounded" onclick="previewImage(this)"
                            src="{{asset('storage/'. $product?->thumbnail)}}" width="60px" height="60px" alt="">
                    </button>
                    @foreach ($product->showcase as $images)
                    <button class="p-1 rounded mb-1">
                        <img width="60px" height="60px" class=" border p-1 rounded" onclick="previewImage(this)"
                            src="{{asset('storage/'. $images?->image)}}" width="60px" height="60px" alt="">
                    </button>
                    @endforeach
                </div>
                @endif

            </div>
        </div>

        <div class=" w-full " style="min-width: 300px">
            <div>
                {{-- Shop --}}
                <div class="text-green-900 w-full text-sm">

                    <strong>
                        <x-nav-link class="px-2 rounded-xl bg-gray-50 "
                            href="{{route('shops.visit', ['id' => $product?->owner?->resellerShop(), 'name' => $product?->owner?->resellerShop()->shop_name_en])}}">
                            {{$product?->owner?->resellerShop()->shop_name_en ?? "N/A"}}
                        </x-nav-link>
                    </strong>
                </div>
                <div style="font-size: 28px; font-weight:bold;" class="capitalize">{{$product->title}}</div>
                <div class="flex justify-between items-center py-2" style="font-size: 14px">

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


            {{-- category --}}
            <div class=" text-sm flex items-center">

                <div class="text_primary bold rounded">
                    <a wire:navigate href="{{route('category.products' , ['cat' =>$product->category?->slug])}}">
                        {{$product->category?->name ?? "Undefined"}}
                    </a>
                </div>
            </div>

            {{-- comments --}}
            <div class="bg-gray-50">
                <x-hr />
                <i class="fas fa-comments px-2"></i> {{$product->comments->count()}} Reviews.
                <x-hr />
            </div>
            {{-- comments --}}

            {{-- attr --}}
            @if ($product->attr?->value)
            <div class="py-2 my-3 ">
                <h4> {{ Str::ucfirst($product->attr?->name) }} </h4>
                @php
                $arrayOfAttr = explode(',', $product->attr?->value);
                @endphp
                <div class="flex flex-wrap justify-start items-center my-1" style="flex-wrap: wrap;gap: 10px;">
                    @foreach ($arrayOfAttr as $attr)
                    <div class="px-2 text-sm bg-indigo-300 text-white rounded mr-1 d-none @if($attr) d-block @endif"
                        style="align-content:center; text-align:center">
                        {{ Str::upper($attr) }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- optional delivery --}}
            @if ($product->shipping_note)
            <div class=" flex bg-gray-50">
                <p class="p-2 text-xs">
                    {{$product->shipping_note}}
                </p>
            </div>
            @endif
            {{-- optional delivery --}}

            {{-- price --}}
            <div class="py-3">

                @if($product->offer_type)
                <div class="">
                    <div style="font-size:20px; margin-right:12px"> Price : <strong class="text_secondary bold">
                            {{$product->discount}} TK </strong></div>

                    <div class="flex justify-start items-baseline">
                        <del class="" style="font-size: 15px">
                            MRP: {{$product->price}} TK
                        </del>
                        @php
                        $originalPrice = $product->price;
                        $discountedPrice = $product->discount;
                        $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
                        @endphp
                        <div class="text-xs px-2">{{ round($discountPercentage, 0) }}% OFF</div>
                    </div>
                </div>
                @else
                <div style="font-weight:bold;font-size:22px; color:var(--brand-primary); margin-right:12px"> Price :
                    {{$product->price}} TK </div>
                @endif

            </div>
            <x-hr />

            <div class="purchase-info flex justify-start items-center w-full space-x-2">
                <x-primary-button wire:navigate
                    href="{{route('product.makeOrder', ['id' => $product->id, 'slug' => $product->slug])}}">
                    Buy Now<i class="fas fa-arrow-right ms-2"></i>
                </x-primary-button>

                @volt('cartAdd')
                <x-secondary-button wire:click="addToCart" type="button" class="option1">
                    <i class="fas fa-cart-plus"></i> <span class="hidden md:block"></span>
                </x-secondary-button>
                @endvolt

            </div>
        </div>

    </div>


    @if (isset($relatedProduct))
    <hr>
    <div class="sm:w-full ">

        <div class="font-bold">
            Related Products
        </div>
        <br>

        <div class="product_section">
            <x-client.products-loop :products="$relatedProduct" />
        </div>

    </div>
    @endif

    <script>
        function previewImage(element){
            const file = element.src;
            console.log(file);
            document.getElementById('preview').src = file;
           
                
        }
    </script>
</div>
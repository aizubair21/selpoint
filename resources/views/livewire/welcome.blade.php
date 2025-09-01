<div>
    {{--
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}

    <style>
        /* @media only screen and (max-width: 600px) { */
        @media (min-width: 767px) {
            .detail-box h1 {
                font-size: 3rem !important;
                margin-bottom: 0px;
            }
        }

        @media (min-width: 1199px) {
            .detail-box h1 {
                font-size: 4rem !important;
                margin-bottom: 0px;
            }
        }

        @media (max-width: 570px) {

            .slider_bg_box img {
                width: 100%;
                height: auto;
                /* -o-object-fit: cover; */
                /* object-fit: cover; */
                /* -o-object-position: top right;
                object-position: top right; */
                aspect-ratio: 16 / 9;
            }

            .detail-box h1 {
                font-size: 4rem !important;
                margin-bottom: 0px;
            }
        }

        @media (max-width: 767px) {

            .slider {
                /* height:200px!important; */
            }

            /* .slider_bg_box img {
                width: 100%;
                height: 100%;
                -o-object-fit: cover;
                object-fit: cover;
                -o-object-position: top right;
                object-position: top right;
                aspect-ratio: 16 / 9;
            }
            .slider_section {
                padding: 20px 10px;
            }
            .detail-box h1 {
                font-size: 1.5rem!important;
                margin-bottom: 0px;
            }
            .detail-box a {
                margin-top: 0px!important;
                padding: 10px!important;
                font-weight: 500!important;
            }
            .slider_section .detail-box,
            .about_section .detail-box {
                margin-bottom: 0px;
            }
            .slider_section .carousel-indicators li {
                background-color: #ffffff;
                width: 12px!important;
                height: 12px!important;
                border-radius: 100%;
                opacity: 1;
            } */

        }
    </style>


    @livewire('pages.slider')


    <x-dashboard.container>
        {{-- categories --}}
        @if (count($categories))
        <div class="pt-4">
            Categories
        </div>


        <div x-loading.disabled x-transition class="pb-4"
            style="display: grid; grid-template-columns:repeat(auto-fit, 100px); grid-gap:10px">
            @foreach ($categories as $item)
            @if ($item->slug != 'default-category')
            <div class="relative text-center rounded-md "
                style="backdrop-filter:blur(3px); background-color:#fff; height:100px">
                <a href="{{ route('category.products', ['cat' => $item->slug]) }}" style="height: 100px;" wire:navigate>
                    <img src="{{asset('storage/'.$item->image)}}" class="w-full h-full" alt="">
                    <div class="absolute bottom-0 shadow w-full text-center" style="background-color:
                                        #f6f6f69c; backdrop-filter:blur(6px)">
                        {{ Str::limit($item->name, 9, '...') }}
                    </div>ss
                </a>
            </div>
            @endif
            @endforeach
        </div>
        @endif

        <div x-init="$wire.getProducts">
            <div class="py-4 flex px-2 justify-between items-center">
                <div class="text-xl font-bold">
                    New Arrival
                </div>

                <div class="text-center">
                    <x-nav-link href="{{route('products.index')}}" class="px-3 py-2 rounded ">
                        View All
                    </x-nav-link>
                </div>
            </div>
            <div class="product_section pt-4" x-loading.disabled x-transition>
                {{-- @includeIf('components.client.common-heading') --}}
                {{--
                <x-client.products-loop :$products /> --}}
                @if (count($products))
                <div class=""
                    style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px">
                    @foreach($products as $product)
                    <x-client.product-cart :$product :key="$product->id" />
                    @endforeach
                </div>
                @endif

            </div>

            @livewire('pages.topSales')

            @livewire('pages.RecomendedProducts')
        </div>

</div>



{{-- <div class="py-4 flex px-2 justify-between items-center">
    <div class="text-xl font-bold">
        Top Sell
    </div>


</div> --}}
{{-- @livewire('reseller.resel.categories') --}}
</x-dashboard.container>

@script

<script>
    const slides = document.querySelectorAll(".slide");
            const prevBtn = document.querySelector(".prev");
            const nextBtn = document.querySelector(".next");

            let current = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove("active"));
                slides[index].classList.add("active");
            }

            prevBtn.addEventListener("click", () => {
                current = (current - 1 + slides.length) % slides.length;
                showSlide(current);
            });

            nextBtn.addEventListener("click", () => {
                current = (current + 1) % slides.length;
                showSlide(current);
            });
    
</script>
@endscript

</div>
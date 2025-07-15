<div>
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}

    <style>
        /* @media only screen and (max-width: 600px) { */
        @media (min-width: 767px) {
            .detail-box h1 {
                font-size: 3rem!important;
                margin-bottom: 0px;
            }
        }
        @media (min-width: 1199px) {
            .detail-box h1 {
                font-size: 4rem!important;
                margin-bottom: 0px;
            }
        }
        @media (max-width: 570px){

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
                font-size: 4rem!important;
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


        .body {
        margin: 0;
        font-family: sans-serif;
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        
        }

        .slider {
        position: relative;
        width: 100%;
        /* max-width:90; */
        height: 250px;
        overflow: hidden;
        /* border-radius: 10px; */
        /* box-shadow: 0 5px 15px rgba(0,0,0,0.2); */
        background: #fff;
        }

        .slides {
        width: auto;
        height: 100%;
        }

        .slide {
        width: 100%;
        height: 100%;
        display: none;
        object-fit: cover;
        }

        .slide.active {
        display: block;
        }

        button.prev,
        button.next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        border: none;
        color: #fff;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 20px;
        border-radius: 50%;
        }

        button.prev {
        left: 10px;
        }

        button.next {
        right: 10px;
        }

        .body button:hover {
        background: rgba(0,0,0,0.7);
        }

    </style>


    <!-- slider section -->
    @if (0)
        <section class="slider_section bg-white hidden" >
            <div>
                <div class="slider_bg_box">
                    
                </div>
                <div id="customCarousel1" class="carousel slide w-full" data-ride="carousel">
                    <div class="carousel-inner w-full">
                        @foreach ($slides as $key => $item)
                            <div class="carousel-item ">
                                {{-- <img src="{{asset('assets/user/images/slider-bg.jpg')}}" alt="">  --}}
                                <img style="width:100%" src="{{asset('/storage')."/".$item}}" alt=""> 
                            </div>
                        @endforeach
                        {{-- @foreach ($slides as $key => $sl)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="container ">
                                    <div class="row">
                                        <div class="col-md-7 ">
                                            <div class="detail-box text-left">
                                                <h1 class="display-lg-4 bold">
                                                    <span">
                                                        {{$sl?->main_title ?? ""}}
                                                    </span>
                                                    <br>
                                                    {{$sl?->subtitle ?? ""}}
                                                </h1>
                                                <p class="d-none d-lg-block">
                                                    {{$sl?->description ?? ""}}
                                                </p>
                                                <div class="">
                                                    <a href="" class="btn btn_secondary">
                                                            Shop Now
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        
                        {{-- <div class="carousel-item active">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                        <div class="detail-box text-left">
                                            <h1 class="display-lg-4 bold">
                                                <span>
                                                    Sale 20% Off
                                                </span>
                                                <br>
                                                On Everything
                                            </h1>
                                            <p class="d-none d-lg-block">
                                                Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam
                                                fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat
                                                molestias, veniam, vel architecto veritatis delectus repellat modi impedit
                                                sequi.
                                            </p>
                                            <div class="">
                                                <a href="" class="btn btn_secondary">
                                                        Shop Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                        <div class="detail-box text-left">
                                            <h1 class="display-lg-4 bold">
                                                <span>
                                                    Sale 20% Off
                                                </span>
                                                <br>
                                                On Everything
                                            </h1>
                                            <p class="d-none d-lg-block">
                                                Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam
                                                fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat
                                                molestias, veniam, vel architecto veritatis delectus repellat modi impedit
                                                sequi.
                                            </p>
                                            <div class="">
                                                <a href="" class=" btn btn_secondary">
                                                        Shop Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="container flex justify-center lg:justify-start">
                        <ol class="carousel-indicators px-1 m-0 p-0 rounded mt-lg-5" style="background-color: rgb(234, 234, 234)">
                            @if (count($slides) > 1)      
                                @foreach ($slides as $key => $sl)
                                <li data-target="#customCarousel1" data-slide-to="{{$key}}" class=" {{ $key == 0 ? 'active' : ""}} "></li>
                                @endforeach
                            @endif
                            {{-- <li data-target="#customCarousel1" data-slide-to="1"></li>
                            <li data-target="#customCarousel1" data-slide-to="2"></li> --}}
                        </ol>
                    </div>
                </div>
            </d>
        </section>
    @endif
    <div class="body">

        <div class="slider">
        <div class="slides">
            @foreach ($slides as $key => $item)      
                <img src="{{asset('storage'."/".$item)}}" class="slide {{ $key == 0 ? 'active' : '' }}" />
            @endforeach
            {{-- <img src="https://via.placeholder.com/800x400?text=Product+2" class="slide" />
            <img src="https://via.placeholder.com/800x400?text=Product+3" class="slide" /> --}}
        </div>
        <button class="prev"><i class="fas fa-chevron-left"></i></button>
        <button class="next"><i class="fas fa-chevron-right"></i></button>
        </div>

    </div>
    <!-- end slider section -->
    
    <x-dashboard.container>
        <div x-init="$wire.getProducts">
            
            <div class="product_section layout_padding" x-loading.disabled x-transition>
                {{-- @includeIf('components.client.common-heading') --}}
                {{-- <x-client.products-loop :$products /> --}}
                @if (count($products))     
                    <div class="" style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, 160px); grid-gap:10px">
                        @foreach($products as $product)
                            <x-client.product-cart :$product :key="$product->id" />
                        @endforeach    
                    </div>
                @endif
        
            </div>

        </div>
    
        <div class="text-center">
            <x-nav-link href="{{route('products.index')}}" class="px-3 py-2 rounded btn_outline_secondary">
                View All products
            </x-nav-link>
        </div>


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

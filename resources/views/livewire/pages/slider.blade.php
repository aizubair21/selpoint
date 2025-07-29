<div>

    @assets
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"> --}}
    @endassets
    <style>
        .body {
            margin: 0;
            font-family: sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            }

            .slider {
            position: relative;
            width: 100%;
            max-height: 400px;
            overflow: hidden;
            /* border-radius: 10px; */
            /* box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); */
            background: #fff;
            aspect-ratio: 16/9;
            }

            .slides {
            width: 100%;
            height: 100%;
            position: relative;
            }

        .slide {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transform: scale(0.95);
            visibility: hidden;
            transition: opacity 0.6s linear, transform 0.6s linear;
            display: flex;
            align-items: center;
            }

            .slide.active {
            opacity: 1;
            transform: scale(1);
            visibility: visible;
            z-index: 2;
            }

            .slide img {
            width: 100%;
            height: 100%;
            object-fit: unset;
            position: absolute;
            z-index: 0;
            top: 0;
            left: 0;
            }

            .description {
                position: relative;
                z-index: 1;
                max-width: 400px;
                color: #000000;
                background: #002c3e09;
                padding: 30px;
                margin-left: 40px;
                opacity: 0;
                transform: translateX(-50px);
                transition: opacity 0.6s linear, transform 0.6s linear;
                /* filter: blur(10px); */
                backdrop-filter: blur(8px);
                border-radius: 10px;
                overflow: hidden;
            }

            .slide.active .description {
            opacity: 1;
            transform: translateX(0);
            }
            
            .description h1 {
            margin: 0 0 10px;
            font-size: 28px;
            }

            .description p {
            margin: 0 0 15px;
            font-size: 16px;
            }

            .description .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #22c55e;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
            }

            .description .btn:hover {
            background: #16a34a;
            }

            .dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 9;
            }

            .dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.4);
                cursor: pointer;
                transition: background-color 0.3s;
            }
            
            .dot.active {
                background-color: #000;
            }
            .slide.exit {
            opacity: 0;
            transform: scale(0.95);
            visibility: hidden;
            z-index: 1;
            }
    </style>

    @if ($slides?->count())
        <div class="body">

            <div class="slider">
                <div class="slides">
                    @foreach ($slides as $key => $item)      
                    <div class="slide {{ $key == 0 ? 'active' : '' }}">
                        {{-- <img src="https://via.placeholder.com/800x400?text=Product+1" loading="lazy" /> --}}
                        <a href="{{ $item->action_url ?? route('products.index') }}" wire:nvigation class="slide-link">
                            {{-- <img src="https://placehold.co/600x400/orange/white" /> --}}
                            <img src="{{asset('storage'."/".$item->image)}}" />
                        </a>
                        @if ($item->main_title)
                            <div class="description hidden md:block">
                                {{-- <div class="description"> --}}
                                <div>

                                    <h1>{{$item->main_title }}</h1>
                                    <p class="hidden md:block" >{{$item->description }}</p>
                                    {{-- @if ($item->action_url)
                                        <a href="{{$item->action_url}}" class="btn">Shop Now</a>
                                    @else
                                        <a href="{{route('products.index')}}" class="btn">Shop Now</a>
                                    @endif --}}
                                
                                </div>
                            </div>
                        @endif
                    </div>
                    @endforeach
                    {{-- <img src="https://placehold.co/600x400/orange/white" class="slide" /> --}}
                    {{-- <img src="https://via.placeholder.com/800x400?text=Product+2" class="slide" />
                    <img src="https://via.placeholder.com/800x400?text=Product+3" class="slide" /> --}}
                </div>

                @if ($slides->count() > 1)
                    
                    <button class="prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="next"><i class="fas fa-chevron-right"></i></button>
                    <div class="dots">
                        @foreach ($slides as $key => $item)

                            <span @class(['dot', 'active' => $loop->first ])"dot" data-index="{{$key}}"></span>
                            {{-- <span class="dot" data-index="1"></span> --}}
                            {{-- <span class="dot" data-index="2"></span> --}}
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
    @endif


    {{-- <section class="splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($slides as $item)
                
                    <li class="splide__slide">Slide 01</li>
                    <li class="splide__slide">Slide 02</li>
                    <li class="splide__slide">Slide 03</li>
                @endforeach
            </ul>
        </div>
    </section> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js" ></script> --}}
    

        
        
    @script
        <script>

        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");

        let current = 0;
        let interval = null;

        function showSlide(index) {
        if (index === current) return;

        const currentSlide = slides[current];
        const nextSlide = slides[index];

        // Start exit animation
        currentSlide.classList.add("exit");

        // After animation ends, clean up the old slide
        setTimeout(() => {
            currentSlide.classList.remove("active", "exit");
        }, 600); // match transition duration in CSS

        // Show the new slide
        nextSlide.classList.add("active");

        // Update dots
        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });

        current = index;
        }

        dots.forEach(dot => {
        dot.addEventListener("click", () => {
            const index = parseInt(dot.getAttribute("data-index"));
            showSlide(index);
            restartAutoplay();
        });
        });

        function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
        }

        function startAutoplay() {
        interval = setInterval(nextSlide, 5000);
        }

        function stopAutoplay() {
        clearInterval(interval);
        }

        function restartAutoplay() {
        stopAutoplay();
        startAutoplay();
        }

        startAutoplay();
        
        </script>
    @endscript
</div>

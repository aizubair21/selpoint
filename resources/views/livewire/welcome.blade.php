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
    </style>


    @livewire('pages.slider')


    <x-dashboard.container>

        @includeIf('components.client.display-category', ['categories' => $categories])

        @livewire('pages.new-product')
        @livewire('pages.todays-product')

        @if (count($products))

        <div class="py-4">
            <div class="py-4 flex px-2 justify-between items-center">
                <div class="text-xl font-bold">
                    Products
                </div>

                <div class="text-center">
                    <x-nav-link href="{{route('products.index')}}" class="px-3 py-2 rounded ">
                        View All
                    </x-nav-link>
                </div>
            </div>
            <div class="product_section" x-loading.disabled x-transition>
                <x-client.products-loop :$products />
            </div>

        </div>
        @endif

        @livewire('pages.topSales')
        @livewire('pages.static-slider', ['placement' => 'middle', 'page' => 'home'])
        @livewire('pages.RecomendedProducts')
        @livewire('pages.static-slider', ['placement' => 'bottom', 'page' => 'home'])
    </x-dashboard.container>
</div>




@script

{{-- <script>
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
    
</script> --}}

{{-- <script>
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


  

</script> --}}
@endscript



</div>
<div>

    
    <style>
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
        height: 400px;
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

    @if ($slides?->count())
        <div class="body">

            <div class="slider">
            <div class="slides">
                @foreach ($slides as $key => $item)      
                    <img src="{{asset('storage'."/".$item)}}" class="slide {{ $key == 0 ? 'active' : '' }}" />
                @endforeach
                {{-- <img src="https://via.placeholder.com/800x400?text=Product+2" class="slide" />
                <img src="https://via.placeholder.com/800x400?text=Product+3" class="slide" /> --}}
            </div>

                @if ($slides->count() > 1)
                    
                    <button class="prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="next"><i class="fas fa-chevron-right"></i></button>
                @endif
            </div>

        </div>
    @endif


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

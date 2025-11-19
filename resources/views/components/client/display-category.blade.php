<div>
    @props(['categories'])

    {{-- categories --}}
    @if (count($categories))

    <div x-loading.disabled x-transition class="relative py-4 overflow-x-scroll " id="cat_div">
        {{-- <div id="cat_wrapper" class="flex gap-3 overflow-x-auto scroll-smooth no-scrollbar"> --}}
            <div id="cat_wrapper" class="flex gap-3 ">
                @foreach ($categories as $item)
                @if ($item->slug != 'default-category')
                <div class="text-center bg-white rounded-md cat_item"
                    style="backdrop-filter:blur(3px); width:100px; height:100px">
                    <a href="{{ route('category.products', ['cat' => $item->slug]) }}"
                        class="flex flex-col items-center w-full h-full "
                        style="width:100px!important; height:100px!important;" wire:navigate>
                        <img src="{{asset('storage/'.$item->image)}}"
                            style="width:100px!important; height:100px!important; " class="rounded-md" alt="">
                        <div class="pt-1 w-full text-center absolute bottom-0" style="background-color:
                                            #f6f6f69c; backdrop-filter:blur(6px)">
                            {{ Str::limit($item->name, 9, '...') }}
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
            </div>

            {{-- <div class="navigation_btn absolute flex justify-between w-full items-center px-3 lg:px-6 "
                style="top:50px; transform:translatey(-50%)">
                <button id="prev_btn" class="border rounded-full p-2 bg-gray-900 text-white" onclick="paginateCat('+')">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button id="next_btn" class="border rounded-full p-2 bg-gray-900 text-white" onclick="paginateCat('-')">
                    <i class="fas fa-angle-right"></i>
                </button>
            </div> --}}
        </div>
        @endif
        <script>
            function paginateCat(val)
        {
        const catdiv = document.getElementById('cat_div')
        const catwrap = document.getElementById('cat_wrapper')
        const catItem = document.getElementsByClassName('cat_item')
        
        const displayWidth = catdiv.clientWidth;
        const catItemWidth = 100;
        const catwrapwidth = catwrap.clientWidth;
        const scrollAmount = catItem.length * catItemWidth;
        let count = 0;
        let scroll = 0;
        
        console.log( scrollAmount, displayWidth);
        if (displayWidth < scrollAmount) {
    
            if (val == '+') {
                count = count + 1;
                if (scroll + catItemWidth >= scrollAmount) {
                    count = 0;
                    scroll = 0;
                }
            } else if (val == '-') {
                count = count --;
                if (scroll - catItemWidth < 0) {
                    count = Math.floor(scrollAmount / catItemWidth) - 1;
                    scroll = (Math.floor(scrollAmount / catItemWidth) - 1) * catItemWidth;
                }
            }
         
    
            console.log(count, scroll);
    
            catwrap.scrollTo({
                left: scroll,
                behavior: 'smooth'
            });
        }
            
        }
        </script>
    </div>
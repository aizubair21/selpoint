<div>

    @if (config('setup.footer.status'))

    <section class="bg-white text-black py-12">
        <x-dashboard.container>

            <div class="container mx-auto px-4">
                @php
                $layout = [];
                $foot = App\Models\FooterLayout::where('name', 'default')->first();
                if ($foot) {
                $layout = json_decode($foot->layout, true);
                }
                @endphp
                @foreach($layout['sections'] as $section)
                <div class="mb-10">

                    <!-- Section Title -->
                    @if(!empty($section['title']))
                    <h2 class="text-lg font-bold mb-4">
                        {{ $section['title'] }}
                    </h2>
                    @endif

                    <div class="grid gap-5 lg:grid-cols-{{ count($section['columns']) }} sm:grid-cols-1">

                        @foreach($section['columns'] as $col)

                        <div class="space-y-3">

                            @foreach($col['widgets'] as $widget)

                            {{-- TEXT WIDGET --}}
                            @if($widget['type'] === 'text' && !empty($widget['content']))
                            <p class="text-gray-800 text-sm leading-relaxed">
                                {{ $widget['content'] }}
                            </p>
                            @endif

                            {{-- LINK WIDGET --}}
                            @if($widget['type'] === 'link' && !empty($widget['url']))
                            <a href="{{ $widget['url'] }}" class="text-orange-400 text-sm hover:underline block">
                                {{ $widget['label'] ?? 'Link' }}
                            </a>
                            @endif

                            {{-- ICON WIDGET --}}
                            @if($widget['type'] === 'icon' && !empty($widget['url']))
                            <a href="{{ $widget['url'] ?? '#' }}" target="_blank" class="inline-block mr-3">
                                <img src="{{ asset('storage/') ." /". $widget['url'] }}" alt="icon" class="h-24">
                            </a>
                            @endif

                            @endforeach

                        </div>

                        @endforeach

                    </div>

                </div>
                @endforeach

            </div>

        </x-dashboard.container>
    </section>

    @else

    <div>

        <footer>
            <x-dashboard.container>
                <div class="justify-between"
                    style=" display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap-10">

                    <div class=" py-4 mb-4">
                        <div class="w-full">
                            <div class="logo_footer">
                                <a wire:navigate href="/" class="">
                                    <img height="50px" width="60px" src="{{asset('icon.png')}}" alt="">
                                    <div class="ps-2 text-lg font-bold">
                                        {{-- app name --}}
                                        <x-application-name />
                                    </div>
                                </a>
                            </div>
                            <div class="">
                                <p><strong>ADDRESS:</strong> Uttara, Dhaka</p>
                                {{-- <p><strong>TELEPHONE:</strong> +8801863-767896</p>
                                <p><strong>EMAIL:</strong> gorombazar01@gmail.com</p> --}}
                                <x-nav-link class="py-1 d-block" href="/page/about-us">About US</x-nav-link>
                                <br>
                                <x-nav-link class="py-1 d-block" href="/page/privacy-policy">Privacy Policy</x-nav-link>

                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class=" py-4">
                            <div class="text-lg mb-3 bold">Menu</div>
                            <x-nav-link class="py-1 mb-1 d-block" href="/">Home</x-nav-link>
                            <br>
                            <x-nav-link class="py-1 mb-1 d-block" href="{{ route('products.index') }}">Products
                            </x-nav-link>
                            <br>
                            <x-nav-link class="py-1 mb-1 d-block" href="{{route('category.index')}}">Categories
                            </x-nav-link>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class=" py-4">
                            <div class="text-lg mb-3 bold">Account</div>
                            <x-nav-link class="py-1 mb-1 d-block" href="{{route('login')}}">Login</x-nav-link>
                            <br>
                            <x-nav-link class="py-1 mb-1 d-block" href="{{route('register')}}">Register</x-nav-link>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class=" py-4">
                            <div class="text-lg mb-3 bold">Links</div>
                            <x-nav-link class="py-1 mb-1 d-block" title="earn with gorom bazar" href="/page/earn">Earn
                            </x-nav-link>
                            <br>
                            <x-nav-link class="py-1 mb-1 d-block" title="earn with gorom bazar"
                                href="/page/terms-condition">
                                Terms & Conditions</x-nav-link>
                            <br>
                            <x-nav-link class="py-1 mb-1 d-block" title="Return and Refund policy"
                                href="/page/return-refund">
                                Return & Refund </x-nav-link>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class=" py-4 w-100">

                            <x-nav-link class="d-block mb-2 p-2 d-inline-block rounded text_secondary"
                                href="/page/about-us">
                                <i class="fa-solid fa-phone mr-2"></i> Contact Us
                            </x-nav-link>
                            <br>
                            <x-nav-link class="p-2 px-4 rounded-md btn_outline_secondary bold"
                                href="mailto:gorombazar01@gmail.com">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Mail US
                            </x-nav-link>

                        </div>
                    </div>

                </div>
            </x-dashboard.container>
        </footer>
    </div>
    @endif

    <div class="cpy_">
        <p class="">© 2025 All Rights Reserved</p>
    </div>

</div>
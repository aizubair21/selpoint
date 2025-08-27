<footer>
    <x-dashboard.container>
        <div class="block space-y-5 md:flex justify-between flex-wrap py-lg-4">

            <div class="py-4">
                <div class="w-full">
                    <div class="logo_footer">
                       <a wire:navigate href="/" class="">
                            <img height="50px" width="60px" src="{{asset('icon.png')}}" alt="">
                            <div class="ps-2 text-lg font-bold">
                                {{-- app name  --}}
                                <x-application-name />
                            </div>
                        </a>
                    </div>
                    <div class="information_f widget_menu ">
                        <p><strong>ADDRESS:</strong> Uttara, Dhaka</p>
                        {{-- <p><strong>TELEPHONE:</strong> +8801863-767896</p>
                        <p><strong>EMAIL:</strong> gorombazar01@gmail.com</p> --}}
                        <x-nav-link class="py-1 d-block" href="/page/about-us">About US</x-nav-link>
                        <br>
                        <x-nav-link class="py-1 d-block" href="page/privacy-policy">Privacy Policy</x-nav-link>
                        
                    </div>
                </div>
            </div>
            <div class="">
                <div class="widget_menu py-4">
                    <div class="text-lg mb-3 bold">Menu</div>
                    <x-nav-link class="py-1 mb-1 d-block" href="/">Home</x-nav-link>
                    <br>
                    <x-nav-link class="py-1 mb-1 d-block" href="{{ route('products.index') }}">Products</x-nav-link>
                    <br>
                    <x-nav-link class="py-1 mb-1 d-block" href="{{route('category.index')}}">Categories</x-nav-link>
                    <br>
                    {{-- <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul> --}}
                </div>
            </div>
            <div class="">
                <div class="widget_menu py-4">
                    <div class="text-lg mb-3 bold">Account</div>
                    <x-nav-link class="py-1 mb-1 d-block" href="{{route('login')}}">Login</x-nav-link>
                    <br>
                    <x-nav-link class="py-1 mb-1 d-block" href="{{route('register')}}">Register</x-nav-link>
                    <br>
                    {{-- <ul>
                        <li><a href="{{route('register')}}">Register</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="">
                <div class="widget_menu py-4">
                    <div class="text-lg mb-3 bold">Links</div>
                    <x-nav-link class="py-1 mb-1 d-block" title="earn with gorom bazar" href="/page/earn">Earn</x-nav-link>
                    <br>
                    <x-nav-link class="py-1 mb-1 d-block" title="earn with gorom bazar" href="/page/terms-condition">Terms & Conditions</x-nav-link>
                    <br>
                    <x-nav-link class="py-1 mb-1 d-block" title="Return and Refund policy" href="/page/return-refund">Return & Refund   </x-nav-link>
                    <br>
                    {{-- <ul>
                        <li><a title="earn with gorom bazar" href="{{route('register')}}">Earn</a></li>
                        <li><a title="earn with gorom bazar" href="{{route('register')}}">Terms & Conditions</a></li>
                        <li><a title="Return and Refund policy" href="{{route('register')}}">Refund & Return </a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="">
                <div class="widget_menu py-4 w-100">
                    <x-nav-link class="d-block mb-2 p-2 d-inline-block rounded text_secondary" href="/page/about-us">
                       <i class="fa-solid fa-phone mr-2"></i> Contact Us
                    </x-nav-link>
                    <br>
                    <x-nav-link class="p-2 px-4 w-100 rounded-md btn_outline_secondary bold" href="mailto:gorombazar01@gmail.com">
                        <i class="fa-solid fa-paper-plane mr-2"></i>   Mail US
                    </x-nav-link>
                    <br>
                  
                   
                </div>
            </div>

        </div>
    </x-dashboard.container>
</footer>

<div class="cpy_">
    <p class="mx-auto">© 2025 All Rights Reserved</p>
</div>

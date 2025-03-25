<footer>
    <div class="container">
        <div class="row py-lg-4">
            <div class="col-md-6 col-lg-4 py-4">
                <div class="full">
                    <div class="logo_footer">
                        <a href="/"><img width="100px!important" src="{{asset('logo.png')}}" alt="#" /></a>
                    </div>
                    <div class="information_f widget_menu ">
                        <p><strong>ADDRESS:</strong> Uttara-10, Dhaka</p>
                        {{-- <p><strong>TELEPHONE:</strong> +8801863-767896</p>
                        <p><strong>EMAIL:</strong> gorombazar01@gmail.com</p> --}}
                        <a class="py-1 d-block" href="{{route('about.us')}}">About US</a>
                        <a class="py-1 d-block" href="{{route('about.policy')}}">Privacy Policy</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2">
                <div class="widget_menu py-4">
                    <h3>Menu</h3>
                    <a class="py-1 mb-1 d-block" href="/">Home</a>
                    <a class="py-1 mb-1 d-block" href="{{ route('uproducts.index') }}">Products</a>
                    <a class="py-1 mb-1 d-block" href="{{route('categories.index')}}">Categories</a>
                    {{-- <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="widget_menu py-4">
                    <h3>Account</h3>
                    <a class="py-1 mb-1 d-block" href="{{route('login')}}">Login</a>
                    <a class="py-1 mb-1 d-block" href="{{route('register')}}">Register</a>
                    {{-- <ul>
                        <li><a href="{{route('register')}}">Register</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="widget_menu py-4">
                    <h3>Links</h3>
                    <a class="py-1 mb-1 d-block" title="earn with gorom bazar" href="{{route('about.earn')}}">Earn</a>
                    <a class="py-1 mb-1 d-block" title="earn with gorom bazar" href="{{route('about.terms')}}">Terms & Conditions</a>
                    <a class="py-1 mb-1 d-block" title="Return and Refund policy" href="{{route('about.return')}}">Return & Refund   </a>
                    {{-- <ul>
                        <li><a title="earn with gorom bazar" href="{{route('register')}}">Earn</a></li>
                        <li><a title="earn with gorom bazar" href="{{route('register')}}">Terms & Conditions</a></li>
                        <li><a title="Return and Refund policy" href="{{route('register')}}">Refund & Return </a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="widget_menu py-4 w-100">
                    <a class="d-block mb-2 p-2 d-inline-block rounded text_secondary" href="{{route('about.contact')}}">
                       <i class="fas fa-phone mr-2"></i> Contact Us
                    </a>
                    <a class="p-2 px-4 w-100 rounded-md btn_outline_secondary bold" href="mailto:gorombazar01@gmail.com">
                        <i class="fas fa-paper-plane mr-2"></i>   Mail US
                    </a>
                  
                   
                </div>
            </div>

            {{-- <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Menu</h3>
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a href="{{ route('uproducts.index') }}">Products</a></li>
                                        <li><a href="{{route('categories.index')}}">Categories</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Account</h3>
                                    <ul>
                                        <li><a href="{{route('register')}}">Register</a></li>
                                        <li><a href="{{route('login')}}">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Contact US</h3>
                            <a class="d-block mb-2 px-3 py-1 rounded" href="">Contact Us</a>
                            <p>
                                <a class="border p-2 rounded text_secondary bold " href="mailto:gorombazar01@gmail.com">
                                    <i class="fas fa-paper-plane mr-2"></i>   Mail US
                                </a>
                            </p>
                            <div class="form_sub">
                                <form>
                                    <fieldset>
                                        <div class="field">
                                            <input type="email" placeholder="Enter Your Mail" name="email" />
                                            <input type="submit" value="Send" />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</footer>
<div class="cpy_">
    <p class="mx-auto">© 2025 All Rights Reserved</p>
</div>

<style>
    @media (max-width:991px){
        .cart-count {
            position: absolute;
            top: 5px!important;
            right: 15px!important;
            background-color: var(--brand-secondary);
            font-weight: bold;
            color: white;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50%;
            padding: 2px 6px;
            transform: translate(50%, -50%);
        }
    }
    .cart-count {
        position: absolute;
        top: 5px;
        right: 20px;
        background-color: var(--brand-secondary);
        font-weight: bold;
        color: white;
        font-size: 12px;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 6px;
        transform: translate(50%, -50%);
    }
</style>

<?php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
?>

@auth
    @php
        // $count = DB::table('carts')
        //     ->where('user_id', Auth::user()->id)
        //     ->count();
        $count = '';
    @endphp
@endauth

<!-- header section strats -->
<header class="header_section">
    <div class="container">

        {{-- desktop version  --}}
        <div class="d-block d-lg-none">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                {{-- <a class="navbar-brand" href="/"><img style="height:50px!important; object-fit:cover" src="{{asset('logo.png')}}" alt="#" /></a> --}}
                
                <x-application-logo />

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li @class(["nav-item", 'active' => request()->routeIs('user.index')])>
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li @class(['nav-item', 'active' => request()->routeIs('categories.index')])>
                            <a class="nav-link" href="">Categories</a>
                        </li>
                        <li @class(['nav-item', 'active' => request()->routeIs('uproducts.index')])>
                            <a class="nav-link" href="">Products</a>
                        </li>
                        @auth
                            {{-- @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home" style="font-size: 20px;"></i></a>
                                </li>
                            @endif     --}}
                            <li class="nav-item">
                                <a class="nav-link position-relative" href=""><i class="fas fa-shopping-cart" style="font-size: 20px;"></i> <span class="cart-count">{{$count ?? 0}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{URL::to('/user/dashboard')}}"><i class="fas fa-user-circle" style="font-size: 20px;"></i></a>
                            </li>
                        @endauth    
                        @auth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <li class="nav-item">
                                <a style="color:white;margin-left:5px;"
                                class="nav-link btn text_secondary border" href="{{route('login')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        @else 
                            <li @class(["nav-item", 'active' => request()->routeIs('register')])>
                                <a style="width: 9em" class="nav-link px-3 py-1 rounded fs-4 flex border " href="{{route('register')}}"> <i class="fas fa-user-plus me-2"></i> Sign Up</a>
                            </li>   

                            <li @class(["nav-item", 'active' => request()->routeIs('login')])>
                                <a style="color:white;width:9em;margin-left:9px; " class="rounded nav-link btn_outline_secondary" href="{{route('login')}}"> <i class="fas fa-sign-in-alt me-2"></i> Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>

        </div>

        {{-- mobile version  --}}
        <div class="d-none d-lg-block" >
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <x-application-logo />
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li @class(['nav-item', 'active' => request()->routeIs('*')])>
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li @class(['nav-item', 'active' => request()->routeIs('categories.index')])>
                            <a class="nav-link" href="">Categories</a>
                        </li>
                        <li @class(['nav-item', 'active' => request()->routeIs('uproducts.index')])>
                            <a class="nav-link" href="">Products</a>
                        </li>
                        @auth
                            {{-- @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home" style="font-size: 20px;"></i></a>
                                </li>
                            @endif     --}}
                            <li class="nav-item">
                                <a class="nav-link position-relative" href=""><i class="fas fa-shopping-cart" style="font-size: 20px;"></i> <span class="cart-count">{{$count ?? 0}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" href=""><i class="fas fa-user-circle" style="font-size: 20px;"></i></a>
                            </li>
                        @endauth    
                        @auth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <li class="nav-item">
                                <a style="color:white;margin-left:5px;"
                                class="nav-link btn btn_danger text_secondary border " href="{{route('login')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        @else 
                            <li class="nav-item">
                                <a style="width: 9em" class="nav-link px-3 rounded fs-4 flex border " href="{{route('register')}}"> <i class="fas fa-user-plus me-2"></i> Sign Up</a>
                            </li>   

                            <li class="nav-item">
                                <a style="color:white;width:9em;margin-left:9px" class="rounded nav-link btn_outline_secondary" href="{{route('login')}}"> <i class="fas fa-sign-in-alt me-2"></i> Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>

        </div>

    </div>
</header>
<!-- end header section -->



<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('logo.png')}}" type="">
      <link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon" />

      <title>
         @isset($site_title)
            @yield('site_title')
         @else 
            {{config('app.name')}}
         @endisset
      </title>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])

      <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/bootstrap.css')}}" />
      <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

      {{-- <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/"> --}}
      {{-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      <link href="form-validation.css" rel="stylesheet">

      
      <style>
         th {
               vertical-align: middle!important;
               font-size: 14px;
         }
         #user_asside{
            width: 150px!important;
            height: 100vh;

         }
         #user_asside .asside_link{
            display: flex;
            padding: 15px;
            border-bottom: .5px solid #e5e5e5;
            color: #000;
            margin: 1px 0px;
            cursor: pointer;
         }

         #user_asside .asside_link:hover{
            /* background-color: #e5e5e5; */
            color: var(--brand-secondary);

         }
         #user_asside .asside_link .fas {
            width: 25px;
            text-align: center
         }
         .active{
            /* background-color: #e5e5e5!important; */
            /* border-left:5px solid hsl(23, 100%, 65%); */
            color: var(--brand-secondary)!important;
            font-weight: bold;
         }
         #user_asside .asside_link ~ .vip{
            /* font-size: 20p; */
            
         }
         @media (max-width: 767.98px) {
            #user_asside {
               position: fixed !important;
               bottom: 0 !important;
               left: 0 !important;
               width: 100% !important;
               display: flex;
               justify-content: space-evenly;
               align-items: center;
               height: 50px;
               background-color: #fff !important;
               z-index: 99999;
            }
            #user_asside .asside_link {
               display: flex;
               justify-content: space-between;
               align-items: center;
               border: 0;
               margin: 0px!important;
               padding: 12px 5px!important;
               
            }
            .active{
               border: 0;
               border-bottom: 3px solid var(--brand-secondary)!important;
               font-weight: 900
            }  
         }
      </style> 
      @stack('style')
</head>
   <body>

   
   @include('layouts.user.dash.header')

   <div class="container">
      <div class="row m-0 " >

         {{-- left asside  --}}
         <div id="user_asside" class="position-sm-absolute col-md-3">
            <a class="asside_link @if(request()->routeIs('user.dash')) active @endif" href="{{route('user.dash')}}">
               <i class="fas fa-home"></i>
               <span class="pl-2 d-none d-md-block">
                  Dashboard
               </span>
            </a>
            {{-- <a class="asside_link @if(request()->routeIs('cart.index')) active @endif" href="">
               <i class="fas fa-shopping-cart pr-2"></i>
               <span class="pl-2 d-none d-md-block">
                  Cart
               </span>
            </a> --}}
            <a class="asside_link @if(request()->routeIs('user.view.orders')) active @endif" href="">
               <i class="fas fa-shopping-cart pr-2"></i>
               <span class="pl-2 d-none d-md-block">
                  Order
               </span>
            </a>
            <a class="asside_link vip @if(request()->routeIs('user.vip.*')) active @endif" href="">
               <i class="fas fa-user-check pr-2"></i>
               <span class="pl-2 d-none d-md-block">
                  VIP
               </span>
            </a>
            <a class="asside_link vip @if(request()->routeIs('user.coin.*')) active @endif" href="">
               <i class="fas fa-coins pr-2"></i>
               <span class="pl-2 d-none d-md-block">
                  Wallet
               </span>
            </a>
         </div>


         {{-- right content  --}}
         <div id="user_content" class="col-md-9 p-0 p-lg-3 w-100">
           
            @yield('content')

         </div>
      </div>

   </div>


   {{-- @include('layouts.user.footer') --}}
   {{-- <script src="{{asset('assets/user/js/jquery-3.4.1.min.js')}}"></script> --}}
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" ></script>
   {{-- <script src="{{asset('assets/user/js/custom.js')}}"></script> --}}
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}


   </body>
   {{-- @if (session('success'))
      <script>
          toastr.success("{{ session('success') }}", 'Success', {
              positionClass: 'toast-top-right',
              timeOut: 3000
          });
      </script>
   @endif

   @if (session('warning'))
   <script>

      toastr.warning("{{ session('warning') }}", 'warning', {
         positionClass: 'toast-top-right',
         timeOut: 3000
      });
   </script>
   @endif --}}

   @if($message = session('warning'))
      <script>
         // Swal.fire(
         //     'Attention!',
         //     '{{ $message }}',
         //     'warning'
         // )

         Swal.fire({
            title: 'Warning!',
            text: '{{$message}}',
            icon: 'warning',
            confirmButtonText: 'Understood'
         })
      </script>
   @endif

   @if($message = session('success'))
      <script>
         // Swal.fire(
         //     'Attention!',
         //     '{{ $message }}',
         //     'warning'
         // )

         Swal.fire({
            title: 'Success',
            text: '{{$message}}',
            icon: 'success',
            confirmButtonText: 'Done'
         })
      </script>
   @endif

   @if($message = session('error'))
      <script>
         // Swal.fire(
         //     'Attention!',
         //     '{{ $message }}',
         //     'warning'
         // )

         Swal.fire({
            title: 'Error !',
            text: '{{$message}}',
            icon: 'error',
            confirmButtonText: 'Close'
         })
      </script>
   @endif

   @if($message = session('info'))
      <script>
         // Swal.fire(
         //     'Attention!',
         //     '{{ $message }}',
         //     'warning'
         // )

         Swal.fire({
            title: 'Info !',
            text: '{{$message}}',
            icon: 'info',
            confirmButtonText: 'Understood'
         })
      </script>
   @endif

   @stack('script')
</html>
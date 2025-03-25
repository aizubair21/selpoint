<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href={{ asset("logo.png")}} type="">
      <meta name="token" content="{{csrf_token()}}">
      <link rel="icon" href={{ asset("logo.png")}} type="image/x-icon" />
      <title>

         @yield('title')
      </title>

      {{-- google font  --}}
      {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> --}}

      {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}
      <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/bootstrap.css')}}" />
      <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet" />
      {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      {{-- <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/"> --}}
      {{-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      {{-- <link href="form-validation.css" rel="stylesheet"> --}}
      <style>
         th {
             vertical-align: middle!important;
             font-size: 14px;
         }
         .discount-badge {
             position: absolute;
             top: 0;
             left: 0;
             color: white;
             font-weight: bold;
             padding: 3px 8px;
             clip-path: polygon(0px 0px, 85px 0px, 0px 75px);
             width: 100px;
             height: 100px;
             text-align: center;
             display: flex;
             font-size: 18px;
         }
      </style>

      @stack('style')

   </head>
   <body>
      {{-- <x-vipCounter /> --}}


      <div >
        @include('layouts.user.header')
      </div>
      <div class="container">
         @yield('content')
      </div>


      {{-- @include('layouts.user.footer') --}}
      <script src="{{asset('assets/user/js/jquery-3.4.1.min.js')}}"></script>
      <script src="{{asset('assets/user/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/user/js/bootstrap.js')}}"></script>
      <script src="{{asset('assets/user/js/custom.js')}}"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      
   </body>

<script>
   @if (session('success'))
       toastr.success("{{ session('success') }}", 'Success', {
           positionClass: 'toast-top-right',
           timeOut: 3000
       });
   @endif

   @if (session('warning'))
      toastr.warning("{{ session('warning') }}", 'warning', {
         positionClass: 'toast-top-right',
         timeOut: 3000
      });
   @endif
</script>
</html>
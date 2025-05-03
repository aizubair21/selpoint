<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <meta name="token" content="{{csrf_token()}}">

      {{-- <x-site_icon />  --}}

      <link rel="shortcut icon" href={{ asset("logo.png")}} type="">

      <x-site_title />

      <title>
         @isset($site_title)
            @yield('site_title')
         @else 
            {{config('app.name', 'site')}}
         @endisset
      </title>

      {{-- google font  --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
      
      
      {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}
      {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/bootstrap.css')}}" /> --}}
      <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet" />
      <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet" />
      
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
      {{-- <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/"> --}}
      {{-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      {{-- <link href="form-validation.css" rel="stylesheet"> --}}
      <style>
         body{
            background-color: #f0f0f0!important;
         }
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
        @includeIf('layouts.user.navigation')
      </div>

      <div class="">
         {{$slot}}
      </div>

      <div>
         @includeIf('layouts.user.footer')
      </div>


      {{-- <script src="{{asset('assets/user/js/jquery-3.4.1.min.js')}}"></script> --}}
      {{-- <script src="{{asset('assets/user/js/popper.min.js')}}"></script> --}}
      {{-- <script src="{{asset('assets/user/js/bootstrap.js')}}"></script> --}}
      {{-- <script src="{{asset('assets/user/js/custom.js')}}"></script> --}}
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
      
   </body>

   <script>

      document.addEventListener('DOMContentLoaded', function () {
         Livewire.on('info', (data) => {
            Swal.fire({
               title: 'Look At!',
               text: data,
               icon: 'Info',
               confirmButtonText: 'OK'
            })
         });
         Livewire.on('success', (data) => {
            Swal.fire({
               title: 'Congrass !',
               text: data,
               icon: 'success',
               confirmButtonText: 'OK'
            })
         });
         Livewire.on('warning', (data) => {
            Swal.fire({
               title: 'Alart !',
               text: data,
               icon: 'warning',
               confirmButtonText: 'OK'
            })
         });
         Livewire.on('error', (data) => {
            Swal.fire({
               title: 'Attention !',
               text: data,
               icon: 'error',
               confirmButtonText: 'OK'
            })
         });
      });
      
   </script>
</script>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-site_title />
            
        <x-site_icon />
        {{-- <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/bootstrap.css')}}" />
        <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}

        @stack('css')
        <style>
            * {
                box-sizing: border-box !important;
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <x-has-role name="['system','admin']">
            </x-has-role>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                <div class="pb-2 max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <x-errors />
                </div>
                {{ $slot }}
            </main>
        </div>
    </body>

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
</html>

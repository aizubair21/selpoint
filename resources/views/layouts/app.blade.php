<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
        
    </head>
    <body class="font-sans antialiased h-screen overflow-hidden">
        <div class="flex flex-col h-screen bg-gray-100">
            @livewire('layout.navigation')
            {{-- @include('layouts.navigation') --}}
    
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
    
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </body>
    
    @livewireScripts
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

   @if($message = session('warning'))
    <script>
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

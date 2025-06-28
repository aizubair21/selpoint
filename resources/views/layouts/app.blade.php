<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- site icon  --}}
        <link rel="shortcut icon" href="{{asset('icon.png')}}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"> --}}
        
    </head>
    <body class="font-sans h-screen antialiased  overflow-x-hidden">
        <div class="h-full bg-gray-100 ">

            @livewire('layout.navigation')
            {{-- @livewire('component', ['user' => $user], key($user->id)) --}}

            {{-- @if (isset($navigations))
                {{$navigations}}
            @endif --}}
            {{-- @include('layouts.navigation') --}}
    
            <!-- Page Heading -->
            <div class="flex px-2 sm:px-6 lg:px-8">
                <div class="w-48 hidden md:block h-auto">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>

                        @php
                                  $get = auth()->user()->active_nav;   
                        @endphp

                        @includeif('layouts.responsive_navigation')

                        @if (auth()->user()->hasRole('vendor') && $get == 'vendor')
                            {{-- vendor primary nav  --}}
                            @includeif('layouts.vendor.navigation.responsive')
                        @endif
                            
                        @if (auth()->user()->hasRole('reseller') && $get == 'reseller')
                            {{-- reseller primary nav  --}}
                            @includeif('layouts.reseller.navigation.responsive')
                        @endif
                            
                        @if (auth()->user()->hasRole('rider') && $get == 'rider')
                            {{-- rider primary nav  --}}
                        @endif
                    </div>
                </div>
                <div class="w-full ">

                    @if (isset($header))
                        <header class="">
                            <div class="w-full px-2 mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
            
                    <!-- Page Content -->
                    <main class="overflow-y-auto">
                        {{ $slot }}
                    </main>

                </div>
            </div>
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

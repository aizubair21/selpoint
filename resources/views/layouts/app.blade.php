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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('css')
        <style>
            * {
                box-sizing: border-box !important;
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <x-has-role name="system">
                @include('layouts.navigation')
            </x-has-role>

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
</html>

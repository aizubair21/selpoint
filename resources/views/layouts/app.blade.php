<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'nolicx') }}</title>

    {{-- site icon --}}
    <link rel="shortcut icon" href="{{asset('icon.png')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> --}}

    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"> --}}
    <style>
        /* td,
        th {
            white-space: nowrap
        } */

        tr:hover {
            background-color: #f3f4f6
        }

        tr:nth-child(even) {
            background-color: #f9fafb
        }
    </style>
</head>

<body class="font-sans h-screen antialiased overflow-x-hidden bg-gray-100">
    <div class="h-full  overflow-y-auto">
        <x-client.support-button />
        @livewire('layout.navigation')


        <!-- Page Heading -->
        <div class="flex sm:px-6 lg:px-8 ">
            <div class=" hidden md:block h-auto" style="width:220px">
                <div class="pt-2 pb-3 w-full">
                    {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link> --}}

                    @php
                    $get = auth()->user()->active_nav;
                    @endphp

                    @includeif('layouts.responsive_navigation')

                    @if (auth()->user()->hasRole('vendor') && $get == 'vendor')
                    {{-- vendor primary nav --}}
                    @includeif('layouts.vendor.navigation.responsive')
                    @endif

                    @if (auth()->user()->hasRole('reseller') && $get == 'reseller')
                    {{-- reseller primary nav --}}
                    @includeif('layouts.reseller.navigation.responsive')
                    @endif

                    @if (auth()->user()->hasRole('rider') && $get == 'rider')
                    {{-- rider primary nav --}}
                    @includeIf('layouts.rider.navigation.responsive_navigation')
                    @endif
                </div>
            </div>
            <div class="w-full">

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
                    title: 'Attention',
                    text: data,
                    icon: 'Info',
                    confirmButtonText: 'OK'
                })
            });
            Livewire.on('success', (data) => {
                Swal.fire({
                    title: 'Done',
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
                    title: 'Error !',
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

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('open-printable', (data) => {
            // Use an async IIFE to safely use await inside a non-module environment
            (async () => {
            try {
            // --- Basic checks ---
            console.log('PDF generation started');
            if (typeof html2canvas === 'undefined') {
            console.error('html2canvas is not loaded (undefined).');
            alert('html2canvas not loaded. Make sure the CDN script tag is present.');
            return;
            }
            if (typeof window.jspdf === 'undefined') {
            console.error('jsPDF is not loaded (window.jspdf undefined).');
            alert('jsPDF not loaded. Make sure the CDN script tag is present.');
            return;
            }
            
            // Get jsPDF constructor
            const { jsPDF } = window.jspdf || {};
            if (typeof jsPDF !== 'function') {
            console.error('jsPDF import failed, window.jspdf:', window.jspdf);
            alert('jsPDF not available. Check console for window.jspdf object.');
            return;
            }
            
            // Find the element to convert
            const element = document.querySelector('#pdf-content');
            if (!element) {
            console.error('No element found with id="pdf-content"');
            alert('No #pdf-content element found. Please add id="pdf-content" to the container you want to export.');
            return;
            }
            
            console.log('Calling html2canvas on element:', element);
            
            // --- Call html2canvas and await the promise ---
            const canvas = await html2canvas(element, { scale: 2, useCORS: true });
            
            // Debug: what did we get?
            console.log('html2canvas resolved value:', canvas);
            if (!canvas) {
            throw new Error('html2canvas returned null/undefined.');
            }
            
            // Validate it's a canvas and has toDataURL
            if (typeof canvas.toDataURL !== 'function') {
            console.error('Returned object is not a canvas or has no toDataURL. Constructor/type:', canvas.constructor?.name ||
            typeof canvas);
            // Extra attempt: if html2canvas returned an array or object, try to get .canvas property
            if (canvas?.canvas && typeof canvas.canvas.toDataURL === 'function') {
            console.warn('Using canvas.canvas.toDataURL fallback');
            doPdfFromCanvas(canvas.canvas, jsPDF);
            return;
            }
            throw new Error('The object returned by html2canvas does not support toDataURL.');
            }
            
            // All good -> create PDF
            doPdfFromCanvas(canvas, jsPDF);
            
            } catch (err) {
            console.error('PDF generation failed:', err);
            alert('PDF generation error — see console for details: ' + (err && err.message ? err.message : err));
            }
            })();
        });
        
    });

    // Helper that takes a valid HTMLCanvasElement and opens PDF
    function doPdfFromCanvas(canvas, jsPDF) {
        try {
            const imgData = canvas.toDataURL('image/png');
            
            // Create ajsPDF instance sized to A4
            const pdf = new jsPDF({
            orientation: 'p',
            unit: 'mm',
            format: 'a4'
            });
            
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            
            const imgWidth = pageWidth;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            // If image is taller than page, we add it and let PDF client handle multiple pages
            pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
            
            const blob = pdf.output('blob');
            const url = URL.createObjectURL(blob);
            window.open(url, '_blank');
            
            console.log('PDF created and opened in new tab.');
        } catch (err) {
            console.error('doPdfFromCanvas failed:', err);
            alert('Failed to create PDF from canvas: ' + err.message);
        }
    };
    
        
</script> --}}
@stack('script')

</html>
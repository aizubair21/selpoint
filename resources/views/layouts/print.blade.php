<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'nolicx') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.4/b-3.2.5/b-html5-3.2.5/b-print-3.2.5/fh-4.0.4/datatables.min.css"
        rel="stylesheet" integrity="sha384-aKelen8gbywzeVdWLWyaBp/qRkNUydsl79gglSwlp2lwogW2dGBS9DWxgW1eZ7ax"
        crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"
        integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"
        integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous">
    </script>
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.4/b-3.2.5/b-html5-3.2.5/b-print-3.2.5/fh-4.0.4/datatables.min.js"
        integrity="sha384-XA15Ika7T33czAD4/Zkh7J3FU0WX8LUo7A86AGyMJNlq8bSJYRMLO913NMbnUC5f" crossorigin="anonymous">
    </script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
     --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100"> --}}
        <div>
            {{-- <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-24 h-24 fill-current text-gray-500" />
                </a>
            </div> --}}

            {{-- <div class="w-full px-6 py-4 mx-auto flex justify-center overflow-hidden sm:rounded-lg" ">
                {{ $slot }}
            </div> --}}
            {{-- <div class=" w-full px-6 py-4 mx-auto flex justify-center overflow-hidden sm:rounded-lg" ">
            </div> --}}
            {{ $slot }}
        </div>
    </body>

    <script>
        // let table = new DataTable('#myTable', {
        //     autoFill: true,
        //         layout: {
        //             topStart: {
        //                 buttons: [
        //                 'pdf'
        //                 ]
        //             }
        //         }
        //     });

        // $('#myTable').DataTable({
        //     extend: 'pdfHtml5',
        //     customize: function(doc) {
        //         doc.content.table.widths = ['*', '*', '*', '*', '*'];
        //     },
        //     dom: 'Bftip',
        //     buttons: [
        //     'pdf'
        //     ]
        // });

        // var tbl = $('#myTable');
        // var settings={};
        // settings.buttons = [
        // {
        // extend:'pdfHtml5',
        // text:'Export PDF',
        // orientation:'landscape',
        // customize : function(doc){
        // var colCount = new Array();
        // $(tbl).find('tbody tr:first-child td').each(function(){
        // if($(this).attr('colspan')){
        // for(var i=1;i<=$(this).attr('colspan');$i++){ colCount.push('*'); } }else{ colCount.push('*'); } });
        //     doc.content[1].table.widths=colCount; } } ];
            // $('#myTable').ataTable(settings);
    </script>
</html>
<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @assets

    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css"> --}}
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
    </style>
    @endassets
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script> --}}

    <div>
        <h1 class=" p-1 w-full text-center">
            <strong class="text-xl">
                <x-application-name />
            </strong>
            <div class="text-sm">
                {{$nav}} Report
                <p>
                    From {{$sdate}} To {{$edate}}
                </p>
            </div>
        </h1>
    </div>
    <hr />
    <x-dashboard.table>
        <thead>

        </thead>
        <table>

        </table>

        <tfoot>

        </tfoot>
    </x-dashboard.table>
    {{-- <script>
        let table = new DataTable('#myTable');
    </script> --}}
</div>
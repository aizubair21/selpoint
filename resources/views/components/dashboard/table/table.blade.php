<div {{$attributes}} class="overflow-x-scroll ">
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    <style>
        thead th {
            /* vertical-align: bottom; */
            border-bottom: 2px solid #dee2e6;
            padding: 12px;
            font-size: 15px;
            text-align: left;
        }
        td {
            padding: 12px;
            font-size:14px;
        }
       
    </style>
    <table id="myTable" class="w-full mb-2">
            {{$slot}}
    </table>
</div>
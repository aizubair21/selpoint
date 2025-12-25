<div class="rounded d-block border p-3 relative overflow-hidden" style="z-index:1; color:white;">
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <style>
        .div_wrapper {
            position: absolute;
            top: 50px;
            left: -100px;
            transform: translateY(-50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(rgba(255, 166, 0, 0.418), transparent);
            /* background: radial-gradient(hsl(22, 97%, 65%), transparent); */
            z-index: -1;
        }
    </style>

    <div class="text-3xl text-gray-800">
        {{$content ?? " 0 / 0"}}
    </div>

    <div class="text-sm mb-1 text-gray-500">
        {{$title ?? "Overview"}}
    </div>
    <div class="div_wrapper"></div>

</div>
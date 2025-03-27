<div class="rounded d-block shadow p-3 relative overflow-hidden" style="background-color: indigo; z-index:1; color:white;">
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <style>
        .div_wrapper {
            position: absolute;
            bottom: -100px;
            right:-100px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(rgb(12, 165, 94), transparent);
            z-index: -1;
        }
        .div_wrapper::after{
            content: "";
            position: absolute;
            width: 80px;
            height: 80px;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: radial-gradient(green, transparent);
            /* border: 1px dotted indigo; */
            
        }
    </style>
    <h2 class="text-md mb-3">
            {{$title ?? "Overview"}}
    </h2>
    
    <p class="text-end text-2xl">
            {{$content ?? " 0 / 0"}}
    </p>
    
    <div class="div_wrapper"></div>
    
</div>
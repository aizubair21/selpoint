@extends('layouts.user.dash.userDash')

@section('site_title')
    User | {{config('app.name', 'GoromBazar')}}
@endsection

@section('content')

    <div class="my-2 p-1 rounded">
        <div class="border border-success p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Welcome, back!
                </div>
                {{-- <div>
                    {{auth()->user()->created_at->diffForHumans()}}
                </div> --}}
            </div >
            <div class="row align-items-center justify-content-between m-0 p-0">
                <div class="col-md-6 px-0">
                    <b class="text-success" style="font-size: 20px">
                        {{ Str::upper(auth()->user()->name)}}
                    </b>
                </div>
                {{-- <div class="col-md-2 co px-0"></div> --}}
                {{-- <a href="{{route('user.coin.store')}}" class="shadow d-block col-8 col-md-4 text-dark bold rounded-pill border p-1 pl-3 d-flex justify-content-between align-items-center">
                    <div>
                        Earning
                    </div>
                    <div class="d-block px-3 py-1 rounded-pill text-white bg-success " href="">
                        {{auth()->user()->coin ?? "0"}} TK
                    </div>
                </a> --}}
            </div>
                
        </div>
    </div>
    
    {{-- <x-daily-task /> --}}

    {{-- <div class="rounded">
        <div class="p-2 row m-0 border border-info">
            <div class="col-lg-6 bg-info d-flex rounded p-3">
                <div class="text-white">
                    Earning
                </div>
              
                <a href="{{route('user.coin.store')}}" class="text-white fs-1 text-bold" >
                    <x-user.display-user-coin />
                </a>
              

            </div>

            <div class="col-lg-6 d-blok py-0 py-lg-3 px-0 px-lg-2">
                <a href="{{route('user.coin.store', ['nav' => 'comission'])}}" class="my-2 px-3 py-2 rounded border d-flex justify-content-between align-items-center nav-link">
                    <div>
                        Comissions
                        
                    </div>
                    <i class="fas fa-arrow-right"></i>
                </a>

                <a href="{{route('user.withdraw.index')}}" class="my-2 px-3 py-2 rounded border d-flex justify-content-between align-items-center nav-link">
                    <div>
                        Withdraw
                        
                    </div>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div> --}}

    {{-- <x-package-request/> --}}


    @php
    @endphp
    {{-- {!! auth()->user()->getReff()->toArray() !!}; --}}

    <hr>    

    <div class="row m-0 my-2">
        <div class="col-md-6 p-1">
            <div class="border rounded border p-3">
                <div class="font-bold bold text-success " style="font-size:25px">
                    Refer & Claim
                </div>
                <p>
                    Refer your friends and get 5% of every purchase!
                </p>
                <div class=" w-100">
                    <input type="text" disabled readonly id="refID" class=" form-control" value="{{auth()->user()->getRef->ref ?? ""}}" >
                </div>

                <div class="d-flex justify-content-between align-items-center">    
                    <button onclick="copyPaymentNumber(this, 'refID')" class="my-1 btn btn-success btn-sm PX-3 text-right"> <i class="fas fa-copy mr-1"></i> COPY</button>
                    <a class="btn btn-sm btn-outline-info" href="">View Your Referred User</a>
                </div>
            </div>
        </div>

        <div @class(["col-md-6 p-1", 'd-none' => auth()->user()->created_at->diffInHours(Carbon\Carbon::now()) > 72])>
            <div class="border rounded border p-3 position-relative">

                {{-- <form action="{{route('user.set.ref')}}" method="post"> --}}
                <form action="" method="post">
                @csrf

                    <div class="font-bold bold text-info " style="font-size:25px">
                        Claim Your Reward
                    </div>
                    <p>
                        Your friend may give you a referral code.
                    </p>
                    <div class="input-group w-100">
                        @php
                            $rffer = '';
                            if(auth()->user()->reference_accepted_at || auth()->user()->created_at->diffInHours(Carbon\Carbon::now()) > 72)
                            {
                                $rffer = auth()->user()->reference;
                            }

                        @endphp
                        <input type="text" class="w-full form-input form-control" name="reference" value="{{$rffer}}" @disabled(auth()->user()->reference_accepted_at ? true : false) placeholder="Give Referred Code" >
                    </div>  
    
                    <div class="d-flex align-items-center">
    
                        <button type="submit" for="" class="btn btn-info btn-sm my-1 px-3" @disabled(auth()->user()->reference_accepted_at ? true : false) >Apply</button>
                        <div class="input-group-text bg-white border-0">
                            <span class="pr-2" id="timeleft"> </span>
                            {{auth()->user()->created_at->diffForHumans()}}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    

    <div class="row m-0 my-2">
        <div class="col-12 p-1">
            <div class="alert alert-default" style="background-color: rgb(235, 235, 235)">
                <h4 class="bold">Change Password</h4>
                <p>Change your password to secure your account</p>
                <a href="{{route('password.update')}}" class="btn btn-sm btn-danger">Chang Password</a>                
            </div>
        </div>
    </div>
   

    @php
        $targetTime =     $targetTime = \Carbon\Carbon::parse(auth()->user()->created_at)->addHours(72);
    @endphp

@push('script')
    
<script>
    function copyRef() {
        var copyText = document.getElementById("refID");
        navigator.clipboard.writeText(copyText.value)
        .then(function() {
            alert("Copied the text: " + copyText.value);
        })
        .catch(function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    }
    
     // copyPaymentNumber('paymentTo')
     function copyPaymentNumber(e, elementId) 
    {
        const paymentNumberInput = document.getElementById(elementId);
        const tempTextarea = document.createElement("textarea");
        tempTextarea.value = paymentNumberInput.value || paymentNumberInput.textContent || paymentNumberInput.innerText;


          // Append the textarea to the DOM (off-screen)
        tempTextarea.style.position = "fixed";
        tempTextarea.style.opacity = "0";
        document.body.appendChild(tempTextarea);


          // Select the content of the textarea
        tempTextarea.select();
        tempTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected content to the clipboard
        try {
            document.execCommand("copy");
            // console.log("Content copied to clipboard!");
            // alert('copied !')
            e.innerText = 'copied';
            setTimeout(() => {
                e.innerText = 'copy';
            }, 2000);
        } catch (err) {
            console.error("Failed to copy content: ", err);
        }

        // Remove the temporary textarea
        document.body.removeChild(tempTextarea);

        // var refer = document.getElementById('refer_link_display');
        // paymentNumberInput.select();
        // refer.setSelectionRange(0,9999);
        // document.exceCommand('copy');
        // let ke = new keyboardEvent();
        // navigator.clipboard.writeText(refer.value);
        
    }
</script>

@endpush
   
@endsection
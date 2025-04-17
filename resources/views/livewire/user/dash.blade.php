<div>

    {{-- <?php 
    use App\Models\vendor;
    use function Livewire\Volt\{state};
    state(['latestVndor' =>0, 'data' => vendor::latest()]);
    ?> --}}
    
    <x-dashboard.section>
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
                    <x-nav-link wire:navigate href="" class="shadow d-block col-8 col-md-4 text-dark bold rounded-pill border p-1 pl-3 d-flex justify-content-between align-items-center">
                        <div>
                            Earning
                        </div>
                        <div class="d-block px-3 py-1 rounded-pill text-white bg-success " href="">
                            {{auth()->user()->coin ?? "0"}} TK
                        </div>
                    </x-nav-link>
                </div>
                    
            </div>
        </div>
    </x-dashboard.section>

    <x-dashboard.section>
        <div class="row m-0 my-2">
            <div class="col-md-6 p-1">
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Refer and Claim
                    </x-slot>
                    <x-slot name="content">
                        Refer your friends and get 5% of every purchase!
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>

                    <div class=" w-100">
                        <input type="text" disabled readonly id="refID" class=" form-control" value="{{auth()->user()->getRef->ref ?? ""}}" >
                    </div>
    
                    <div class="d-flex justify-content-between align-items-center">    
                        <button onclick="copyPaymentNumber(this, 'refID')" class="my-1 btn btn-success btn-sm PX-3 text-right"> <i class="fas fa-copy mr-1"></i> COPY</button>
                        <x-nav-link wire:navigate class="btn btn-sm btn-outline-info" href="">View Your Referred User</x-nav-link>
                    </div>
                </x-dashboard.section.inner>
                
            </div>

            <div @class(["col-md-6 p-1", 'd-none' => auth()->user()->created_at->diffInHours(Carbon\Carbon::now()) > 72])>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Claim Your Reward
                    </x-slot>
                    <x-slot name="content">
                        Your friend may give you a referral code.
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>
                    <div class=" position-relative">
    
                        {{-- <form action="{{route('user.set.ref')}}" method="post"> --}}
                        <form action="" method="post">
                        @csrf
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
                </x-dashboard.section.inner>
            </div>
        </div>
    </x-dashboard.section>


    {{-- @volt('container')
        <div>
           {{$latestVndor}}
           @php
               dd($data);
           @endphp
        </div>
    @endvolt --}}
    {{-- <x-dashboard.section>
        @php
            $isVendor = auth()->user()->isVendor;
            echo($isVendor->id);
        @endphp
    </x-dashboard.section> --}}
    <x-dashboard.section>

        @push('style')
            <style>
                .add:hover > .wrapAdd{
                    translate: all linear .3s;
                    position: absolute;
                    bottom: 12px;
                    right: 12px!important;
                    width: 10px;
                    height: 10px;
                    translate: all linear .3s;
                    /* border: 1px solid green!important; */

                }
                .wrapAdd{
                    translate: all linear .3s;
                    position: absolute;
                    bottom: 12px;
                    right: 20px;
                    /* padding: 5px; */
                    width: 15px;
                    height: 15px;
                    /* border-radius: 3px; */
                    border-top: 1px solid gray;;
                    border-right: 1px solid gray;;
                    transform: rotate(45deg);
                }
            </style>
        @endpush
        <div style="color:black; display: grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); grid-gap:10px">
            <a wire:navigate href="{{route('upgrade.vendor.index', ['upgrade' => 'vendor'])}}" class="add p-3 rounded shadow my-2 border; " style="position:relative;background:linear-gradient(135deg, rgb(235, 235, 235), lightgreen, rgb(235, 235, 235))">
                <h6 style="font-weight:600; color:green"> Be a Vendor</h6>
                <p style="font-size: 12px; color:black; font-weight:300">
                    Upgrade your account to <strong>VENDOR</strong>, sell product and earn comission.
                </p>
                <div class="wrapAdd"></div>
            </a>
            <a wire:navigate href="{{route('upgrade.vendor.index', ['upgrade' => 'reseller'])}}" class="add p-3 rounded shadow my-2 border; " style="position:relative;background:linear-gradient(135deg, rgb(235, 235, 235), lightgreen, rgb(235, 235, 235))">
                <h6 style="font-weight:600; color:green;" >  Ba Reseller</h6>
                <p style="font-size: 12px; color:black; font-weight:300">
                    Upgrade your account to <strong>Reseller</strong> now. Chose product and sel as yours.
                </p>
                <div class="wrapAdd"></div>
            </a>
            <a wire:navigate href="{{route('upgrade.vendor.index', ['upgrade' => 'rider'])}}" class="add p-3 rounded shadow my-2 border; " style="position:relative;background:linear-gradient(135deg, rgb(235, 235, 235), lightgreen, rgb(235, 235, 235))">
                <h6 style="font-weight:600; color:green;">Be a Rider</h6>
                <p style="font-size: 12px; color:black; font-weight:300">
                    Be a <strong>Delevary Man</strong>, collect product and shipped to destination.
                </p>
                <div class="wrapAdd"></div>
            </a>
        </div>
    </x-dashboard.section>


    
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
</div>

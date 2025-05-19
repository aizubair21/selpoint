<div>
    <x-dashboard.page-header>
        VIP Package
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.inner>
               
                <div class="flex justify-start">
                    
                    <div class="col-md-5 mb-3" style="min-width:250px; max-width: 350px">
                            <x-vip-cart :item="$package" :active="$id" />
                    </div>
                    
                    <div class="col-lg-7 w-100 px-3">
                        <div class="bg-white">        
                            <div class="text-left">
                                <div class="font-bold bold text-lg" >Confirm Payment First</div>
                                <div class="text-sm">Please send TK {{$package->price ?? "0"}} to bellow number. And collect your Tansactions ID for further proccess. We need your Transactions ID to identify it's you.</div>
                                <x-hr />
                                <div class="mt-2">
            
                                    @if ($package->payOption)
            
                                        @foreach ($package->payOption as $item)
                                        
                                            <div class="p-2 rounded border mb-1">
                                                <div class="uppercase" for="">{{ $item->pay_type }} </div>
                                                <div class="flex w-full justify-between items-center">
                                                    <div type="text" id="paymentTo_{{$item->id}}" class="border-0 form-control outline-0 shadow-0 bg-white py-2 text-dark bold"> {{ $item->pay_to }} </div>
                                                    <x-primary-button class="btn btn-sm ml-5 py-0" id="" onclick="copyPaymentNumber(this, 'paymentTo_{{$item->id}}')" >Copy</x-primary-button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
                
                <div class="text-center">
                    {{-- <a  class="btn text-center btn_secondary d-inline-block" href="">View Details</a> --}}
                    <x-secondary-button x-on:click="$dispatch('open-modal', 'package-details-modal')" data-bs-target="#packageDetailsModal">
                        View Details
                    </x-secondary-button>
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>

        <x-dashboard.section>
            <x-dashboard.section.inner>
                <div>
                    <style>
                        .vip_item_info_box{
                            height: 155px;
                            /* border: 1px solid #c7c7c7; */
                            text-align: center;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            /* background-color:white ; */
                            border-radius: 8px
                        }
                        .vip_item_info_box .label {

                        }
                    </style>

                    {{-- <div @class(['col-lg-4 d-block' => $ownerPackage, 'col-12 d-none mt-4'])>
                        <x-vip-cart :item="$package" type='owner' :active="$package->id??''" />
                    </div> --}}

                    <div style="display: grid; grid-template-columns:repeat(auto-fit, 155px); grid-gap:20px; justify-content:center" >
                        
                        <div class="vip_item_info_box shadow">
                            <div>
                                Package <i class="fas fa-check-circle mx-2"></i>
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->name}}
                            </div>
                        </div>
                
                
                        <div class="vip_item_info_box shadow">
                            <div>
                                Price <i class="fas fa-check-circle mx-2"></i>
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->price}} TK
                            </div>
                        </div>
                
                
                        <div class="vip_item_info_box shadow">
                            <div>
                                Daily TK 
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->coin}}
                            </div>
                        </div>
                
                        <div class="vip_item_info_box shadow">
                            <div>
                                Daily Time <i class="fas fa-clock mx-2"></i>
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->countdown}} Min
                            </div>
                        </div>
                
                        {{-- <div @class(["vip_item_info_box shadow d-none", 'd-block' => $package->refer_bonus_owner ])>
                            <div>
                                Refer Bonux <i class="fas fa-link mx-2"></i>
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->refer_bonus_owner}} Min
                            </div>
                        </div>
                
                        <div @class(["vip_item_info_box shadow d-none", 'd-block' => $package->refer_bonus_via_link ])>
                            <div>
                                Give Refer Bonux <i class="fas fa-link mx-2"></i>
                            </div>
                            <hr class="w-100">
                            <div style="font-weight: 900; font-size:24px" class="">
                                {{$package->refer_bonus_via_link}} Min
                            </div>
                        </div> --}}
                
                    </div>
                    <x-hr/>
    
                    <div class="text-center my-3">
                        <x-primary-button x-on:click="$dispatch('open-modal', 'purchase-modal')" @class(["btn btn-lg bg_primary shadow text-white", 'd-none' => $ownerPackage??""])>Procces to Purchase <i class="fas fa-arrow-right mx-2"></i> </x-primary-button>
                    </div>
                </div>


            </x-dashboard.section.inner>
        </x-dashboard.section>

        {{-- description modal  --}}
        <x-modal name="package-details-modal" maxWidth="xl">
            <div class="p-3 border-b bg-white">
                Package Description
            </div>
            <div class="p-3">
               {!! 

                $package->description ?? "No Description Found !"

                !!}
            </div>
        </x-modal>


        {{-- purchase modal  --}}
        <x-modal name="purchase-modal" maxWidth="lg">
            <div class="p-3 border-b">
                Purchase Package
            </div>

            <div class="p-3">
                <div class="">
                        <div class="p-3 border rounded">

                            <div >
                                <div class=" mb-3 ">
                                    <x-input-label for="method">Payment Method </x-input-label>
                                    <select wire:model.live="payment_by" id="method" class="w-full border-0 rounded @error('payment_by')is-invalid @enderror">
                                        <option value="">Select an payment Method</option>
                                        @foreach ($package->payOption as $item)
                                            <option value="{{$item->pay_type}}"> {{$item->pay_type}} - {{$item->pay_to}} </option>
                                        @endforeach
                                        {{-- <option value="Nogod">Nogod</option> --}}
                                    </select>
                                    @error('payment_by')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-floating mb-3">
                                    <x-input-label for="floatingInput">Transaction ID</x-input-label>
                                    <x-text-input type="text" class="w-full" value="{{old('trx')}}" id="floatingInput" wire:model.live="trx" placeholder="AFASDF4574SD4S"/>
                                    <div class="text-xs">
                                        write down the tranx ID.
                                    </div>
                                    @error('trx')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                                

                        </div>            
                    
                        <div class=" my-3 p-3 border rounded">
                         
                            <div>
                                <div class="form-floating mb-3">
                                    <x-input-label for="name">Your Name </x-input-label>
                                    <x-text-input type="text" value="{{old('name')}}" class="w-full @error('name')is-invalid @enderror" placeholder="John Doe" wire:model.live="name" id="name" />
                                    @error('name')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-floating mb-3">
                                    <x-input-label for="phone">Phone Number</x-input-label>
                                    <x-text-input type="text" value="{{old('phone')}}" class="w-full @error('phone')is-invalid @enderror" wire:model.live="phone" placeholder="+880123456789" />
                                    @error('phone')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 p-3 rounded shadow @error('task_type') border border-danger @enderror">
                            <x-input-label for="package_type" class="my-2 fs-2">Task Type</x-input-label>
                            
                            <div class=" m-0 p-3 border  rounded">

                                <div class="col-6 p-2 flex d-flex m-0 align-items-center">
                                    <input type="radio" wire:model.live="task_type" value="daily" id="daily_task" class="m-0 border @error('task_type') is-invalid @enderror" style="width:20px; height:20px" id="" />
                                    <x-input-label for="daily_task" class="m-0 p-0 pl-5" > Daily Task </x-input-label>
                                </div>
                                <div class="text-xs">
                                    Daily task may be completed with in 24 hours. Time has been fixed with package.
                                </div>
                            </div>
                            <hr>
                            
                            <div class="row m-0 p-3 border   rounded">

                                <div class="col-6 p-2 flex d-flex m-0 align-items-center">
                                    <input type="radio" wire:model.live="task_type" value="monthly" id="monthly_task  " class="m-0 border @error('task_type') is-invalid @enderror" style="width:20px; height:20px" id="" />
                                    
                                    <div>
                                        <x-input-label for="monthly_task" class="m-0 p-0 pl-5" > Monthly Task </x-input-label>
                                    </div>
                                </div>
                                <div class="text-xs">
                                    Monthly task may be completed to a day in a month.
                                </div>
                            </div>

                        </div>
                        @error('task_type')
                            <div class="text-xs" style="color:red">{{ $message }}</div>
                        @enderror

                        <div class="border p-3">
                            
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <x-input-label for="nid">Your NID Number</x-input-label>
                                    <x-text-input type="number" value="{{old('nid')}}" name="nid" id="nid" class="w-full @error('nid')is-invalid @enderror" />
                                    @error('nid')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <x-hr/>
                            <div class="nid_img_wrapper row justify-content-center">
                                <div class="col-lg-6">
                                    <div>
                                        Front Side Of NID
                                    </div>
                                    <div class="w-100 nid_img_div">
                                        <img id="front_image_prev" src="" height="50px" style="width: 100%; object-fit:contain" alt="">
                                    </div>

                                    <div class="nid_img_file flex justify-between mt-2">
                                        <x-text-input onchange="previewImage(this, '#front_image_prev')" class="form-control border-0 image_file @error('nid_front')is-invalid @enderror" type="file" wire:model.live="nid_front" id="front_image_file" />
                                        <x-danger-button class="input-group-text rounded bg-danger text-light cursor-pointer" for="" onclick="removeImage(this, '#front_image_prev')"> 
                                            <i class="fas fa-minus"></i>
                                        </x-danger-button>
                                    </div>
                                    @error('nid_front')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br><br>
                                <div class="col-lg-6">
                                    <div>
                                        Back Side of NID
                                    </div>
                                    <div class="w-100 nid_img_div">
                                        <img id="back_image_prev" src="" height="50px" style="width: 100%; object-fit:contain" alt="">
                                    </div>

                                    <div class="nid_img_file flex justify-between mt-2">
                                        <x-text-input onchange="previewImage(this, '#back_image_prev')" class="form-control border-0 image_file @error('nid_back')is-invalid @enderror" type="file" wire:model.live="nid_back" id="back_image_file" />
                                        <x-danger-button class="input-group-text rounded bg-danger text-light cursor-pointer" for="" onclick="removeImage(this, '#back_image_prev')">
                                            <i class="fas fa-minus"></i>
                                        </x-danger-button>
                                    </div>
                                    @error('nid_back')
                                        <div class="text-xs" style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <x-primary-button wire:click.prevent="purchase" type="button">  Confirm <i class="fas fa-arrow-right mx-2"></i></x-primary-button>
                        </div>
                </div>

            </div>
        </x-modal>
    </x-dashboard.container>

    @push('script')
        <script>
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

             function previewImage(e, target)
            {
                if (e.files && e.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) { 
                    document.querySelector(target).setAttribute("src",e.target.result);
                    };
                    reader.readAsDataURL(e.files[0]); 
                }
            }

            function removeImage(e, target_image)
            {
                e.previousElementSibling.value = "";
                document.querySelector(target_image).removeAttribute('src');
            }
        </script>
    @endpush
</div>

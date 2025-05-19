<div>
    <!-- An unexamined life is not worth living. - Socrates -->
    <div>

        <style>
            .vip_cart{
                color: #000;
                overflow: hidden;
                transition: all linear .3s
            }
            .vip_cart:hover{
                box-shadow: 0px 5px 5px #d9d9d9;
                transition: all linear .3s
            }
            .vip_cart .head{
                /* box-shadow: 0px 0px 8px #d9d9d9;     */
                padding: 10px 8px 0px 8px;
                color: hsl(23, 100%, 65%);;
            }
            .vip_cart a {
                color: #000;
            }   
            .vip_item_info_box{
                height: 50px;
                /* border: 1px solid #c7c7c7; */
                text-align: center;
                display: flex;
                justify-content: space-between;
                align-items: center;
                /* background-color:white ; */
                border-radius: 8px;
                padding:0px 12px;
            }
        </style>
        @props(['isRequestedAccepted'])
        @isset($isRequestedAccepted)
            @foreach ($isRequestedAccepted as $req)
                @if ($req->status)
                    @if ($req->task_type == 'prevent')
                        <div class="alert alert-danger">
                            <strong>Warning !</strong> Your task has been <strong>PREVENTED</strong> by admin. <br> Now you are unable to earn by task. Please contact us for more information.
                        </div>
                        
                    @endif
                    {{-- <div @class(["alert alert-success rounded-0 border-bottom my-2 p-2 d-none", 'd-block' => $req->status])>

                        <div class="row justify-content-between w-100 align-items-start">
                            <div class="col-9 pb-1">
                                <h4>Active Packages</h4>
                            
                            </div>
                            <div class="col-3 w-100 text-right ">
                                <button class="btn btn-outline-info btn-md mx-lg-4 d-flex justify-content-between align-items-center">
                                    {{$req->package->name ?? ""}}
                                    <i class="fas fa-sort mx-2"></i>
                                </button>
                            </div>
                        </div>
                
                    </div> --}}
                
                    @if(request()->routeIs('user.vip.*'))
                    
                        <div @class(['row jusitfy-content-between m-0 border p-1' => $req->status, 'block'])>
                    
                            <div class='col-md-6 col-lg-4 mt-4'>
                                <div style="display: grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); grid-gap:20px;" >
                                    <a href="" class="block bold border vip_item_info_box">
                                        
                                        <div class="text-left"> 
                                            <div>
                                                Tasks
                                            </div>
                                            <span class="block text-dark" style="font-size: 10px">
                                                {{ DB::table('user_tasks')->where(['user_id' => Auth::id(), 'package_id' => $req->package_id])->count() ?? "0"}} taks completed
                                            </span>
                                        </div>
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                    
                                    <a href="" class="block bold border vip_item_info_box">
                                        
                                        
                                        <div class="text-left"> 
                                            <div>
                                                Statistics
                                            </div>
                                            <span class="block text-dark" style="font-size: 10px">
                                                Earn {{$req->user?->coin ?? ""}}
                                            </span>
                                        </div>
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                    
                                    <hr>
                                </div>
                            </div>
                    
                            {{-- <div @class(["py-4 px-2 col-12 col-md-6 col-lg-4"]) style="display: grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); grid-gap:20px;" > --}}

                            <div @class(["py-4 px-2 col-12 col-md-6 col-lg-4"]) >

                                <div class="mb-1 vip_item_info_box border">
                                    <div class="">
                                        Package
                                    
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->package?->name ?? "Not Found !"}}
                                    </div>
                                </div>

                                <div class="mb-1 vip_item_info_box border">
                                    <div class="">
                                        Balance
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->user?->coin ?? "0"}}
                                    </div>
                                </div>
                        
                        
                                {{-- <div class="mb-1 vip_item_info_box border">
                                    <div>
                                        Price <i class="fas fa-check-circle mx-2"></i>
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$ownerPackage->package->price}} TK
                                    </div>
                                </div>--}}
                        
                                <div class="mb-1 vip_item_info_box border">
                                    <div>
                                        Earning Rate
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->package?->coin ?? "0"}} coin
                                    </div>
                                </div>
                        
                                <div class="mb-1 vip_item_info_box border">
                                    <div>
                                        Duration <i class="fas fa-clock mx-2"></i>
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->package?->countdown ?? "0"}} Min
                                    </div>
                                </div>
                    
                                <div class="mb-1 vip_item_info_box border">
                                    <div>
                                        Task Type 
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->task_type}}
                                    </div>
                                </div>

                                <div @class(["mb-1 vip_item_info_box border d-none", 'd-block' => $req->package?->refer_bonus_owner ?? "0"])>
                                    <div>
                                        Refer Bonux <i class="fas fa-link mx-2"></i>
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->package?->refer_bonus_owner ?? "0"}} Min
                                    </div>
                                </div>
                        
                                <div @class(["mb-1 vip_item_info_box border d-none", 'd-block' => $req->package?->refer_bonus_via_link ?? "0" ])>
                                    <div>
                                        Give Refer Bonux <i class="fas fa-link mx-2"></i>
                                    </div>
                                    
                                    <div style="font-weight: 600; font-size:18px" class="">
                                        {{$req->package?->refer_bonus_via_link ?? "0"}} Min
                                    </div>
                                </div>
                        
                            </div>
                    
                            <div @class(['col-md-4 d-none d-lg-block mt-4'])>
                                <x-vip-cart :item="$req->package" type='owner' :active="$req->package->id??''" />
                            </div>
                        </div>

                    @endif
                @else 
                    
                    <div class="flex items-start p-3 shadow  bg-white rounded-lg">
                        <i class="fas fa-info p-2 me-4"></i>
                        <div>
                            <div class="bold font-bold">Request In Progress</div>
                            <div>Recently you purchage an package. Your purchage request is in porgress. </div>
                            <br>
                            <table class="w-full">
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            {{-- <a href="{{route('user.package.checkout', ['id' => $req->package_id])}}" class="nav-item">
                                                {{$req->package->name }}
                                            </a> --}}
                                            Package Name

                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($req->created_at)->diffForHumans()}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <x-nav-link-btn href=""> Cancle </x-nav-link-btn>
                        </div>
                    </div>
                @endif
                
            @endforeach
        @endisset

    </div>
</div>
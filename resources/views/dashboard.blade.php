<?php
 
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\vendor;
use App\Models\reseller;
use App\Models\rider;
use App\Models\Product;
use App\Models\Category;
// use function Livewire\Volt\{placeholder, computed};

// new class extends Component {
//     public $usercount = 0, $vd, $avd, $ri, $ari, $rs, $ars, $adm = 0, $aadm, $vp, $avp, $cat;

//     public function mount()
//     {
        
//     }
// } 

$userCount = User::all()->count();
$vd = vendor::query()->get()->count();
$avd = vendor::query()->active()->get()->count();
// $riderCount = user::role('rider')->count();
$rs = reseller::query()->count();
$ars = reseller::query()->active()->count();
$ri = rider::query()->count();
$ari = rider::query()->active()->count();
$adm = user::role('admin')->count();

$vp = Product::query()->get()->count();

$cat = Category::count();

?>

<x-app-layout>
    <x-dashboard.page-header> 
        @if (auth()->user()->hasRole('vendor') && auth()->user()->active_nav == 'vendor')
            Vendor
        @endif
        @if (auth()->user()->hasRole('rider') && auth()->user()->active_nav == 'rider')
            Rider
        @endif
        @if (auth()->user()->hasRole('admin'))
            Admin
        @endif
        @if (auth()->user()->hasRole('reseller') && auth()->user()->active_nav == 'reseller')
            Reseller
        @endif
        Dashboard 
    </x-dashboard.page-header>
 
     {{-- system dashboard over view  --}}
     @if (auth()->user()->hasAnyRole('admin','system'))     
        <x-dashboard.container>
            <x-dashboard.overview.section>
                <x-dashboard.overview.div >
                    <x-slot name="title">
                        Admins
                    </x-slot>
                    <x-slot name="content">
                        
                            <div>
                                {{$adm}}
                            </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Vendors
                    </x-slot>
                    <x-slot name="content">
                        
                            <div>
                                {{$vd}} / {{$avd}}
                            </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Resellers
                    </x-slot>
                    <x-slot name="content">
                        
                            <div>
                                {{$rs}} / {{$ars}}
                            </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Riders
                    </x-slot>
                    <x-slot name="content">
                        
                            <div>
                                {{$ri}} / {{$ari}}
                            </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Users
                    </x-slot>
                    <x-slot name="content">
                        
                            <div>
                                {{$userCount}}
                            </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
                
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        <div class="flex">
                            Products
                            <x-nav-link href="">
                                view
                            </x-nav-link>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        
                        <div>
                            {{$vp}}
                        </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>

                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Category
                    </x-slot>
                    <x-slot name="content">
                        
                        <div>
                            {{$cat}}
                        </div>
                        
                    </x-slot>
                </x-dashboard.overview.div>
            </x-dashboard.overview.section>
            <x-hr />
            {{-- <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Comissions
                    </x-slot>
                    <x-slot name="content">
                        
                    </x-slot>
                </x-dashboard.section.header>
                
                <x-dashboard.section.inner>
                    <x-dashboard.overview.section>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                Total Comission
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                Today
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                This Month
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                    </x-dashboard.overview.section>

                </x-dashboard.section.inner>

            </x-dashboard.section> --}}
        </x-dashboard.container>

        <x-dashboard.container>
            {{-- 
            <div class="row m-0">
                <div class="col-md-6 p-0 col-lg-7">
                        <x-dashboard.section>
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Vendor
                                </x-slot>
                                <x-slot name="content">
                                    last Vendor from you system
                                </x-slot>
                            </x-dashboard.section.header>
                            
                            <x-dashboard.section.inner>
                                @livewire('system.vendors.index', key($user->id))
                            </x-dashboard.section.inner>
                
                        </x-dashboard.section>
                
                        <x-dashboard.section>
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Reseller
                                </x-slot>
                                <x-slot name="content">
                                    Recent Reseller Request
                                </x-slot>
                            </x-dashboard.section.header>
                            
                            <x-dashboard.section.inner>
                                asdfsa
                            </x-dashboard.section.inner>
                
                        </x-dashboard.section>
                
                        <x-dashboard.section>
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Rider
                                </x-slot>
                                <x-slot name="content">
                                    Recent Rider Request
                                </x-slot>
                            </x-dashboard.section.header>
                            
                            <x-dashboard.section.inner>
                                asdfsa
                            </x-dashboard.section.inner>
                
                        </x-dashboard.section>
                </div>
                <div class="col-md-6 p-0 col-lg-5">
                    <x-dashboard.section>   
                        <x-dashboard.section.header>
                            <x-slot name="title">
                                Active Admin
                            </x-slot>
                            <x-slot name="content">
                                View Your Active Admins
                            </x-slot>
                        </x-dashboard.section.header>
    
                        <x-dashboard.section.inner>
                            <x-dashboard.table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                            </x-dashboard.table>
                        </x-dashboard.section.inner>
                    </x-dashboard.section>
                </div>
            </div> --}}

        </x-dashboard.container>
     @endif
 
 
     {{-- vendor dashboard overview  --}}
     @if (auth()->user()->active_nav == 'vendor')     
        <x-has-role name="vendor">
            @includeIf('layouts.vendor.vendor')
        </x-has-role>
     @endif
 
     @if (auth()->user()->active_nav == 'reseller')
         
        {{-- reseller dashboard overview  --}}
        <x-has-role name="reseller">
            @livewire('reseller.dashboard', key('reseller_dash'))
        </x-has-role>   
     @endif
 
     {{-- rider dashboard overview  --}}
 
 
     
 </x-app-layout>
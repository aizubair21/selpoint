<?php
 
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\vendor;
use App\Models\reseller;
use App\Models\rider;
use App\Models\product;
use App\Models\category;
use function Livewire\Volt\{placeholder, computed};
 
 
    placeholder('<div>Loading...</div>');
    // $userCount = computed(function () {
    // return User::count();
    // });
    // $vd = computed(function () {
    // return vendor::query()->get()->count();
    // });
    // $avd = computed(function () {
    // return vendor::query()->active()->get()->count();
    // });
    // $ri = computed(function () {
    // return rider::query()->count();
    // });
    // $ari = computed(function () {
    // return rider::query()->active()->count();
    // });
    // $rs = computed(function () {
    // return reseller::query()->count();
    // });
    // $ars = computed(function () {
    // return  reseller::query()->active()->count();
    // });
    // $adm = computed(function () {
    // return  user::role('admin')->count();
    // });
    // $vp = computed(function () {
    // return  product::query()->get()->count();
    // });



new class extends Component {
    public $usercount = 0, $vd, $avd, $ri, $ari, $rs, $ars, $adm = 0, $aadm, $vp, $avp, $cat;

    public function mount()
    {
        $this->userCount = User::all()->count();
        $this->vd = vendor::query()->get()->count();
        $this->avd = vendor::query()->active()->get()->count();
        // $this->riderCount = user::role('rider')->count();
        $this->rs = reseller::query()->count();
        $this->ars = reseller::query()->active()->count();
        $this->ri = rider::query()->count();
        $this->ari = rider::query()->active()->count();
        $this->adm = user::role('admin')->count();

        $this->vp = product::query()->get()->count();

        $this->cat = category::count();

    }
} 

?>

<x-app-layout>
    <x-dashboard.page-header> 
         @if (auth()->user()->hasRole('vendor'))
             Vendor
         @endif
         @if (auth()->user()->hasRole('rider'))
             Rider
         @endif
         @if (auth()->user()->hasRole('admin'))
             Admin
         @endif
         @if (auth()->user()->hasRole('reseller'))
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
                        @volt('admin')
                            <div>
                                {{$this->adm}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Vendors
                    </x-slot>
                    <x-slot name="content">
                        @volt('vendor')
                            <div>
                                {{$this->vd}} / {{$this->avd}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Resellers
                    </x-slot>
                    <x-slot name="content">
                        @volt('reseller')
                            <div>
                                {{$this->rs}} / {{$this->ars}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Riders
                    </x-slot>
                    <x-slot name="content">
                        @volt('rider')
                            <div>
                                {{$this->ri}} / {{$this->ari}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Users
                    </x-slot>
                    <x-slot name="content">
                        @volt('user')
                            <div>
                                {{$this->userCount}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                
            
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Products
                    </x-slot>
                    <x-slot name="content">
                        @volt('admin')
                            <div>
                                {{$this->vp}}
                            </div>
                        @endvolt
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Category
                    </x-slot>
                    <x-slot name="content">
                        @volt('cat')
                        <div>
                            {{$cat}}
                        </div>
                        @endvolt
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
     <x-has-role name="vendor">
         @includeIf('layouts.vendor.vendor')
     </x-has-role>
 
     {{-- reseller dashboard overview  --}}
     <x-has-role name="reseller">
         @includeIf('layouts.reseller.reseller')
     </x-has-role>   
 
     {{-- rider dashboard overview  --}}
 
 
     
 </x-app-layout>
@extends('layouts.user.dash.userDash')

@section('site_title')
    Vendor Upgrade
@endsection

@section('content')
    <div>


        <x-dashboard.section >
            <x-dashboard.section.header>
                <x-slot name="title">
                    Vendor Request Form
                </x-slot>

                <x-slot name="content">
                    Request to be a vendor
                    <div class="d-flex justify-content-between">
                  
                        <a href="" class="">
                            <x-secondary-button>
                                previous request
                            </x-secondary-button>
                        </a>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>
       
       <x-dashboard.section>
           <x-dashboard.section.inner>
               {{-- <x-dashboard.section class="bg-gray-100"> --}}
                   <form action="{{route('upgrade.vendor.store')}}" method="post"> 
                       @csrf
                       <x-input-field label="Your Shop Name English" name="shop_name_en" error="shop_name" />
                       <x-input-field label="Your Shop Name bangls" name="shop_name_bn" error="shop_name" />
                           
                       <x-primary-button>
                           continue
                       </x-primary-button>
                   </form>
               {{-- </x-dashboard.section> --}}
           </x-dashboard.section.inner>
       </x-dashboard.section>

    </div>

@endsection
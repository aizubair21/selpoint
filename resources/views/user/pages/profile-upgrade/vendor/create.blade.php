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
                        <a href="{{route('upgrade.vendor.create')}}" class="btn btn-success btn-sm">
                            
                        </a>
            
                        <a href="" class="">
                            <x-secondary-button>
                                previous request
                            </x-secondary-button>
                        </a>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>
       
       
        <div class="alert alert-info">
            {{-- <x-dashboard.section class="bg-gray-100"> --}}
                <form action="" method="post"> 
                    @csrf
                    <x-input-field label="Your Shop Name" name="shop_name" error="shop_name" />
                        
                    <x-primary-button>
                        Submit
                    </x-primary-button>
                </form>
            {{-- </x-dashboard.section> --}}
        </div>

    </div>

@endsection
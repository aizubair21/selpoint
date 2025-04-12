@extends('layouts.user.dash.userDash')

@section('site_title')
    Vendor Upgrade
@endsection

@section('content')
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">    
                <h5>Vendor Upgrade</h5>
            </x-slot>
    
            <x-slot name="content">
                Upgrade your account to venor to sell your product. To make a new request , click the button below. or check the status of your previous request.
                <div class="md:flex justify-between">
                    <a href="{{route('upgrade.vendor.create')}}">
                        <x-primary-button>
                            New REQUEST
                        </x-primary-button>
                    </a>
        
                    <a href="" class="mt-2 md:mt-0 block">
                        <x-secondary-button>
                            previous request
                        </x-secondary-button>
                    </a>
                </div>
            </x-slot>
        </x-dashboard.section.header>
    </x-dashboard.section>

    <x-dashboard.section>
        asdfdf
    </x-dashboard.section>


@endsection
@extends('layouts.user.dash.userDash')

@section('site_title')
    Vendor Upgrade
@endsection

@section('content')
    <div class="p-2">

        <h5>Vendor Upgrade</h5>


        <div class="d-flex justify-content-between">
            <a href="{{route('upgrade.vendor.create')}}">
                <x-primary-button>
                    New REQUEST
                </x-primary-button>
            </a>

            <a href="" class="">
                <x-secondary-button>
                    previous request
                </x-secondary-button>
            </a>
        </div>
    </div>
    <x-hr/>

    <x-dashboard.section>
        asdfdf
    </x-dashboard.section>


@endsection
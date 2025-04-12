@extends('layouts.user.dash.userDash')

@section('title')
    Vendor Request
@endsection

@section('content')
    
    <x-dashboard.page-header>
        Vendors Request
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Vendor Request
                </x-slot>
                <x-slot name="content">
                    Edit and Upgrade Your Vendor Request Form
                    
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                @php
                    $nav = request('nav') ?? "basic";
                @endphp
                <div class="flex">
                    <x-nav-link :active="$nav == 'basic'" href="{{url()->current()}}?nav='basic'">
                        Basic
                    </x-nav-link>
                    <x-nav-link :active="$nav == 'document'" href="{{url()->current()}}?nav='document'">
                        Document
                    </x-nav-link>
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>

        @if ($nav == 'basic')    
            <form action="{{route('upgrade.vendor.update', ['id' => $data->id])}}" method="post"> 
                @csrf
                {{-- @include('user.pages.profile-upgrade.vendore.partials.basic') --}}
                @include('user.pages.profile-upgrade.vendor.partials.basic')


                {{-- <x-dashboard.section>
                    <x-dashboard.section.inner>
                    </x-dashboard.section.inner>
                </x-dashboard.section> --}}
            </form>
        @endif
    </x-dashboard.container>
@endsection
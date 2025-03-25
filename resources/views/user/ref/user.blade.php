@extends('layouts.user.dash.userDash')

@section('site_title')
    Your Referrer User | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
<div class="container">
    <div class="overflow-x-scroll">
        <div class="alert alert-success">
            <h4>Referrer User</h4>
            <p>
                You accept referrer by <strong> {{auth()->user()->getReffOwner?->owner?->name ?? "User Not Found"}} </strong>. And You have total {{count($refUser) ?? "0"}} referrer user. 
            </p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Comission</th>
                    <th>Join</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($refUser as $key => $ru)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td> {{$ru->name}} </td>
                        <td>0</td>
                        <td>
                            {{$ru->updated_at->toFormattedDateString()}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
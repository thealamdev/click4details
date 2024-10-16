@extends('layouts.master')
@section('title', 'Availables')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Client Details
                    </div>
                    <div class="card-body">
                        <a href="{{ route('home.detail', ['slug' => $notification_detail->data['slug']]) }}">Show Car
                            Details</a>
                        @if (isset($client))
                            <p>User Name: {{ $client?->name }}</p>
                            <p>Mail :{{ $client?->email }}</p>
                            <p>Phone : {{ $client?->shippingAddress?->mobile }}</p>
                            <p>Address : {{ $client?->shippingAddress?->address }}</p> 
                             <a href=""><button class="btn btn-success">Send Mail</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

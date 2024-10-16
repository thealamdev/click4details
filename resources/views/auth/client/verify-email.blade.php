@extends('layouts.patron')
@section('title', 'Verify Email')
@section('content')
<div class="login">
    <div class="login-content">
        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congrats!</strong> A new verification link has been sent to the email address if registered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @else
        <div class="alert alert-light" role="alert">
            <h4 class="alert-heading">Email Verification</h4>
            <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
            <hr>
            <p class="mb-0">If you didn't receive the email, we will gladly send you another.</p>
        </div>
        @endif
        <div class="d-flex gap-2 align-items-center">
            <form method="POST" action="{{ route('client.verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-dark d-block w-100 py-2 border-0">
                    <i class="fa-solid fa-envelope me-1"></i>Resend Verification Email
                </button>
            </form>
            <form method="POST" action="{{ route('client.logout') }}">
                @csrf
                <button type="submit" class="btn btn-default d-block w-100 py-2 border-white">
                    <i class="fa-solid fa-power-off me-1"></i>Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.patron')
@section('title', 'Reset Password')
@section('content')
<div class="login">
    <div class="login-content">
        <form action="{{ route('merchant.password.store') }}" method="POST" accept-charset="utf-8" autocomplete="on">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <h1 class="text-center mb-0">Reset Password</h1>
            <div class="text-muted text-center mb-4">For your protection, please verify your identity</div>
            <div class="mb-3">
                <label class="form-label fw-500 mb-1" for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg fs-15px" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            </div>
            <div class="mb-3">
                <label class="form-label mb-1 fw-500" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg fs-15" required autocomplete="new-password" />
            </div>
            <div class="mb-3">
                <label class="form-label fw-500 mb-1" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg fs-15px" required autocomplete="new-password" />
            </div>
            <button type="submit" class="btn btn-dark d-block w-100 fw-500 mb-3 py-2">
                Confirm and Reset Password<i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
            </button>
        </form>
    </div>
</div>
@endsection
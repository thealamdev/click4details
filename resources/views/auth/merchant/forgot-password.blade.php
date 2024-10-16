@extends('layouts.patron')
@section('title', 'Forgot Password')
@section('content')
<div class="login">
    <div class="login-content">
        <form action="{{ route('merchant.password.email') }}" method="POST" accept-charset="utf-8" autocomplete="on">
            @csrf
            <h1 class="text-center mb-0">Forgot Password?</h1>
            <div class="text-muted text-center mb-4 fw-500">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</div>
            <div class="mb-3">
                <label class="form-label mb-1 fw-500" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg fs-15" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>
            <button type="submit" class="btn btn-dark d-block w-100 fw-500 mb-3 py-2">
            Email Password Reset Link<i class="fa-solid fa-paper-plane ms-1"></i>
            </button>
            @if (Route::has('register.create'))
            <div class="text-center text-muted">
                Remember your password? <a href="{{ route('merchant.login.create') }}">Sign in</a>.
            </div>
            @endif
        </form>
    </div>
</div>
@endsection
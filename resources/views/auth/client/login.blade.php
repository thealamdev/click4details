@extends('layouts.patron')
@section('title', 'Login')
@section('content')
<div class="login">
    <div class="login-content">
        <form action="{{ route('client.login.store') }}" method="POST" accept-charset="utf-8" autocomplete="on">
            @csrf
            <h1 class="text-center mb-0">Sign In</h1>
            <div class="text-muted text-center mb-4">For your protection, please verify your identity</div>
            <div class="mb-3">
                <label class="form-label mb-1 fw-500" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg fs-15" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>
            <div class="mb-3">
                <div class="d-flex">
                    <label class="form-label mb-1 fw-500" for="password">Password</label>
                    <a href="{{ Route::has('client.password.request') ? route('client.password.request') : 'javascript:;' }}" class="ms-auto text-muted">Forgot password?</a>
                </div>
                <input type="password" name="password" id="password" class="form-control form-control-lg fs-15" required autocomplete="current-password" />
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me" />
                    <label class="form-check-label fw-500" for="remember_me">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark d-block w-100 fw-500 mb-3 py-2">
                Confirm and Sign In<i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
            </button>
            @if (Route::has('register.create'))
            <div class="text-center text-muted">
                Don't have an account yet? <a href="{{ route('client.register.create') }}">Sign up</a>.
            </div>
            @endif
        </form>
    </div>
</div>
@endsection
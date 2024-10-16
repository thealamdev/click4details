@extends('layouts.patron')
@section('title', 'Register')
@section('content')
    <div class="login">
        <div class="login-content">
            <form action="{{ route('customer-care.register.store') }}" method="POST" accept-charset="utf-8" autocomplete="on">
                @csrf
                <h1 class="text-center mb-0">Create Merchant Customer Care</h1>
                <p class="text-muted text-center">One Merchant ID is all you need to access all the services.</p>
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1" for="name">User Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg fs-15px"
                        value="{{ old('name') }}" required autofocus autocomplete="name" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-500 mb-1" for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" class="form-control form-control-lg fs-15px"
                        value="{{ old('mobile') }}" required autofocus autocomplete="name" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-500 mb-1" for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg fs-15px"
                        value="{{ old('email') }}" required autocomplete="username" />
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg fs-15px"
                        required autocomplete="new-password" />
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control form-control-lg fs-15px" required autocomplete="new-password" />
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="agree" id="agree">
                        <label class="form-check-label fw-500" for="agree">I have read and agree to the
                            <a href="javascript:;">Terms of Use</a> & <a href="javascript:;">Policies</a>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-dark d-block w-100 fw-500 mb-3 py-2">
                        Confirm and Sign Up<i class="fa-solid fa-arrow-right ms-1"></i>
                    </button>
                </div>
                @if (Route::has('customer-care.login.create'))
                    <div class="text-muted text-center">
                        Already have an Admin ID? <a href="{{ route('client.login.create') }}">Sign In</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

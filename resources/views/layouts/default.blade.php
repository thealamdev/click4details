<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>Home | Pilot Bazar</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/brand.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="{{ asset('assets/css/frontend/main.css?v-', rand(1, 9)) }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @livewireStyles()
</head>

<body>
    @livewire('shared.navbar-shared')
    @livewire('shared.header-shared')
    <main>
        {{ $slot }}
    </main>
    @livewire('shared.footer-shared')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/frontend/color.js') }}"></script>
    @stack('script')
    @livewireScripts()
</body>

<script>
    window.onscroll = (function(e) {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    })
</script>

</html>






<!-- @extends('layouts.patron')
@section('title', 'Login')
@section('content')
    <div class="login">
         
        <div class="login-content p-4 shadow" style="border: 2px solid gray !important;border-radius:5px;">
            <h4 class="text-center">If you having any trouble contact with +8801969944400</h4>
            <form action="{{ route('merchant.login.store') }}" method="POST" accept-charset="utf-8" autocomplete="on">
                @csrf
                <h1 class="text-center mb-0">Sign In</h1>
                <div class="text-muted text-center mb-4">For your protection, please verify your identity</div>
                {{-- <div class="mb-3">
                    <label class="form-label mb-1 fw-500" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg fs-15"
                        value="{{ old('email') }}" required autofocus autocomplete="username" />
                </div> --}}
                <div class="mb-3">
                    <label class="form-label mb-1 fw-500" for="email">Mobile Number</label>
                    <input type="number" id="mobile" name="mobile" class="form-control form-control-lg fs-15"
                        value="{{ old('mobile') }}" required autofocus autocomplete="username" />
                </div>
                <div class="mb-3">
                    <div class="d-flex">
                        <label class="form-label mb-1 fw-500" for="password">Password</label>
                        <a href="{{ Route::has('merchant.password.request') ? route('merchant.password.request') : 'javascript:;' }}"
                            class="ms-auto text-muted">Forgot password?</a>
                    </div>
                    <input type="password" name="password" id="password" class="form-control form-control-lg fs-15"
                        required autocomplete="current-password" />
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
                {{-- @if (Route::has('register.create')) --}}
                <div class="text-center text-muted">
                    Don't have an account yet? <a href="{{ route('merchant.register.create') }}">Sign up</a>
                </div>
                {{-- @endif --}}
            </form>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .login {
            background: url(https://mir-s3-cdn-cf.behance.net/project_modules/hd/9d048261029043.5a60d07f2b8b2.gif);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush -->
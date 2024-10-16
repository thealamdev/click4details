<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pilot bazar console management system" />
    <meta name="author" content="Pilot Kabir" />
    <meta name="copyright" content="Pilot Bazar" />
    <meta name="develop" content="QubeNext" />
    <meta name="website" content="https://qubenext.com" />
    <meta name="contact" content="Shah Alam (+880 1795678789)" />
    <title>@yield('title') | {{ config('app.name', 'Pilot Bazar') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="{{ asset('assets/css/backend/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/backend/main.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @stack('css')
</head>

<body>
    <div id="app" class="app app-full-height app-without-header">
        @yield('content')
        <a href="javascript:;" data-click="scroll-top" class="btn-scroll-top fade">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>

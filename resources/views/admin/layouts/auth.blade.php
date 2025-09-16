<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php $styleCss = 'style'; @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl()}}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!-- General CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages.css') }}">
    <!-- CSS Libraries -->
    @stack('css')
</head>
<body>
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed authImage">
    @yield('content')
</div>
<footer>
    <div class="container-fluid padding-0">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-6">
                <div class="copyright text-center text-muted">
                    All rights reserved &copy; {{ date('Y') }} 
                    <a href="{{ route('landing.home') }}" target="_blank" class="font-weight-bold ml-1">{{getSettingValue('application_name')}}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="{{ mix('js/third-party.js') }}"></script>
<script src="{{ asset('assets/js/custom/helpers.js') }}"></script>
<script src="{{ mix('assets/js/auth/auth.js') }}"></script>

@stack('scripts')
<script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300)
    })
</script>
</body>
</html>


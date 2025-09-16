 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php $styleCss = 'style'; @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!-- General CSS Files -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

    @yield('page_css')
    @livewireStyles
    @yield('css')


    @routes
    @livewireScripts
    <script src="{{ asset('js/turbo.js')}}"
            data-turbolinks-eval="false" data-turbo-eval="false">
    </script>
    <script>
        let defaultImage = '{{asset('front_landing/images/team-3.png') }}'
        let defaultEventCategoryImage = '{{asset('front_landing/images/events-2.png') }}'
        let defaultTeamImage = '{{asset('front_landing/images/team-2.png') }}'
        let brandDefaultImage = '{{ asset('front_landing/images/turbologo.png') }}'
        let sweetAlertIcon ='{{ asset('images/remove.png') }}'
        let sweetWithdrawAlertIcon = '{{asset('images/Alert.png')}}'
        let paypalPaymentType = '{{ \App\Models\Withdraw::PAYPAL }}'
    </script>
    <script src="{{ mix('js/third-party.js') }}"></script>
    <script src="{{ mix('js/pages.js') }}"></script>

    @yield('scripts')
</head>
<body>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid">
        @include('user.layouts.sidebar')
        <div class="wrapper d-flex flex-column flex-row-fluid">
            <div class='container-fluid d-flex align-items-stretch justify-content-between px-0'>
                @include('user.layouts.header')
            </div>
            <div class="content d-flex flex-column flex-column-fluid pt-7">
                @yield('header_toolbar')
                <div class='d-flex flex-wrap flex-column-fluid'>
                    @yield('content')
                </div>
            </div>
            <div class='container-fluid'>
                @include('user.layouts.footer')
            </div>
        </div>
    </div>
    @include('profile.changePassword')
</div>
</body>
</html>

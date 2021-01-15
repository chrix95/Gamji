<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('files/logo.svg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('page')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('layouts.css')
</head>
<body @if(!\Auth::check()) themebg-pattern="theme1" @endif>
    @if (!\Auth::check())
        @yield('content')
    @else
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <!-- [ Pre-loader ] end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                @include('layouts.header-nav')
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        @include('layouts.sidebar')
                        <div class="pcoded-content">
                            @include('layouts.breadcrumb')
                            <!-- [ breadcrumb ] end -->
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <!-- Page body start -->
                                        <div class="page-body">
                                            @yield('content')
                                        </div>
                                        <!-- Page body ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="styleSelector">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('layouts.js')
</body>
</html>

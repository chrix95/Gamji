<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>
<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    @if(!\Auth::check())
        @yield('content')
    @else
        <div>
            @include('layouts.sidebar')
            <div class="page-container">
                @include('layouts.header-nav')
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">
                        @yield('content')
                    </div>
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                    <span>Copyright © {{ date('Y') }} Designed by 
                        <a href="https://devchris.com.ng" target="_blank" title="Devchris">
                            Devchris
                        </a>.
                        All rights reserved.
                    </span>
                </footer>
            </div>
        </div>
    @endif
    <div id="app">
    </div>
    <script type="text/javascript">window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
        loader.classList.add('fadeOut');
        }, 300);
    });</script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-23581568-13');
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script defer src="../../../static.cloudflareinsights.com/beacon.min.js"
    data-cf-beacon='{"rayId":"5f60a2757a0ec500","version":"2020.11.6","si":10}'></script> --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="ou1nz1ouf1QJGjJrhNY298pZjj5M-LhKsYCtVLbd9AM" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        {{ view('app.inc.topBar') }}

        {{ view('app.inc.logo') }}

        {{ view('app.inc.navbar') }}
        
        <div class="text-center">
            {{ view('app.inc.hero') }}
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

        {{ view('app.inc.footer') }}
    </div>
</body>
</html>

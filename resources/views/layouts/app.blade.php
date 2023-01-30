<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="ou1nz1ouf1QJGjJrhNY298pZjj5M-LhKsYCtVLbd9AM"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ view('app.inc.meta') }}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script data-ad-client="ca-pub-7373056434778961" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body>    
    <div id="app">
        {{ view('app.inc.topBar') }}

        {{ view('app.inc.navbar') }}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-0 col-lg-3 col-xl-3 mx-auto p-2 d-none d-sm-none d-md-none d-lg-block">
                    <aside class="py-4">
                        {{ view('app.inc.leftSidebar') }}
                    </aside>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-6 col-xl-6 mx-auto p-2">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 mx-auto p-2 d-none d-sm-block">
                    <aside class="py-4">
                        {{ view('app.inc.rightSidebar') }}
                    </aside>
                </div>
            </div>
            <div class="row">
                @if (trim($__env->yieldContent('extra')))                
                    @yield('extra')
                @endif
            </div>
        </div>

        {{ view('app.inc.footer') }}
    </div>
</body>
</html>

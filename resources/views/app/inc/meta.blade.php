<!-- Meta Tags -->
@if (trim($__env->yieldContent('title')))
    <title>@yield('title')</title>
    <meta property="og:title" content="@yield('title')" />
@else
    <title>News Zilla | Every Thing To Know</title>
@endif

<meta name="url" content="{{ Request::url() }}">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:type" content="website" />

@if (trim($__env->yieldContent('image')))
    <meta name="image" content="@yield('image')">
    <meta property="og:image" content="@yield('image')">
@endif

@if (trim($__env->yieldContent('description')))
    <meta name="description" content="@yield('description')">
    <meta property="og:description" content="@yield('description')">
@else
    <meta name="description" content="News Zilla Provide Every Thing you need to know. News Zilla brings the trending, latest news and top stories around the world ...">
    <meta property="og:description" content="News Zilla Provide Every Thing you need to know. News Zilla brings the trending, latest news and top stories around the world ...">    
@endif

<link rel="icon" href="{{ asset('imgs\favicon.png') }}" type="image/png">

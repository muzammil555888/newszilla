<nav class="navbar navbar-expand-md navbar-dark shadow-bottom border-bottom border-light sticky-top bg-red py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="font-weight-bold text-uppercase main-navbar-logo">News<span class="text-light bg-dark px-2">Zilla</span></span> <br>
            <span class="text-uppercase small text-open-sans">Everything to know</span>
            {{-- <span class="text-uppercase small text-roboto">Everything to know</span> --}}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto text-uppercase text-sm font-weight-bold">
                <li class="nav-item px-1">
                    <a href="{{ url('/') }}" class="nav-link text-light">Home</a>
                </li>
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        @if ($category->status)
                        <li class="nav-item px-1">
                            <a href="{{ url('/ct/'.$category->slug) }}" class="nav-link text-light">{{ $category->title }}</a>
                        </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</nav>
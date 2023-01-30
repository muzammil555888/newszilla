<section class="bg-dark p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <a href="" class="text-light">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <span> Twitter</span>
                </a> &nbsp;
                <a href="" class="text-light">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    <span>Facebook</span> 
                </a> &nbsp;
                <a href="" class="text-light">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <span>Instagram</span>
                </a> &nbsp;
                <a href="" class="text-light">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                    <span>Linkedin</span>
                </a>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-right">
                <ul class="list-inline mb-0">
                    <!-- Authentication Links -->
                    @guest
                        <li class="list-inline-item">
                            <a class="text-light" href="{{ route('login') }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="list-inline-item">
                                <a class="text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="list-inline-item">
                            <a href="{{ url('/dashboard') }}" class="text-light">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-light" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</section>
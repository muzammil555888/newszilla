<div class="main-navbar sticky-top bg-danger">
  <!-- Main Navbar -->
  <nav class="navbar align-items-stretch navbar-dark flex-md-nowrap p-0">
    <ul class="navbar-nav border-left flex-row ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white text-nowrap px-3" href="#" id="navbarDropdown" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="user-avatar rounded-circle mr-2" src="images/avatars/0.jpg" alt="">
          <span class="d-none d-md-inline-block">{{ Auth::user()->name }} Dashboard</span>
        </a>
        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('/user/show') }}">
            <i class="material-icons text-danger">&#xE7FD;</i> Profile</a>
          <a class="dropdown-item" href="{{ url('/myblogposts') }}">
            <i class="material-icons text-danger">vertical_split</i> My Blog Posts</a>
          <a class="dropdown-item" href="{{ url('/post/create') }}">
            <i class="material-icons text-danger">note_add</i> Add New Post</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }} 
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          </a>
        </div>
      </li>
    </ul>
    <nav class="nav">
      <a href="#" class="nav-link nav-link-icon toggle-sidebar d-sm-inline d-md-none text-center border-left"
        data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
        <i class="material-icons text-white">&#xE5D2;</i>
      </a>
    </nav>
  </nav>
</div>
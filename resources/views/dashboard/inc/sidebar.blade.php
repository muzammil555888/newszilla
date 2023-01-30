<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
      <nav class="navbar align-items-stretch navbar-dark bg-danger flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="{{ url('/dashboard') }}" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="" alt="">
            <span class="d-none d-md-inline ml-1">NewsZilla Dashboard</span>
          </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="material-icons text-danger">edit</i>
            <span>Blog Dashboard</span>
          </a>
        </li>
        @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/category') }}">
            <i class="material-icons text-danger">view_module</i>
            <span>Blog Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/post') }}">
            <i class="material-icons text-danger">vertical_split</i>
            <span>Blog Posts</span>
          </a>
        </li>
        @endif
        @if (Gate::allows('isAdmin') || Gate::allows('isManager') || Gate::allows('isAuthor'))
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/myblogposts') }}">
            <i class="material-icons text-danger">vertical_split</i>
            <span>My Blog Posts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/post/create') }}">
            <i class="material-icons text-danger">note_add</i>
            <span>Add New Post</span>
          </a>
        </li>
        @endif
        @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/video') }}">
            <i class="material-icons text-danger">table_chart</i>
            <span>Blog Videos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/page') }}">
            <i class="material-icons text-danger">table_chart</i>
            <span>Blog Pages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/user') }}">
            <i class="material-icons text-danger">note_add</i>
            <span>Blog Users</span>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/user/show') }}">
            <i class="material-icons text-danger">person</i>
            <span>User Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/') }}">
            <i class="material-icons text-danger">home</i>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }} 
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          </a>
        </li>
      </ul>
    </div>
</aside>
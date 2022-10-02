<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home-screen') }}">Practice App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('posts') }}">Posts</a>
          </li>
          @if (Auth::user() && Auth::user()->role_as == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('employees.index') }}">Employee</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Users
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="{{ route('users.index') }}">Users Page</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('ajax-users.index') }}">Users with Ajax</a>
                </li>
              </ul>
            </li>
          @endif
          @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('home') }}">My Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('home') }}">My Account</a></li>
                <li>
                  <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </li>
        @endguest
      </ul>
    </div>
   </div>
</nav>
<nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
  <div class="container">
    <a href="{{ url('/') }}" class="navbar-brand ml-3 ml-sm-2 ml-md-1 ml-lg-0">
      <img
        src="{{ url('/img/logo.png') }}"
        alt="Hobi Sedekah"
        class="brand-image ml-md-2"
        style="opacity: 0.8;transform:scale(1.2,1.2)"
      />
      <p class="text-xs text-muted text-capitalize m-0 p-0" style="color:rgb(175, 175, 175) !important;">#HidupBerkahBerlimpah</p>
    </a>
    <button
      class="navbar-toggler order-1"
      type="button"
      data-toggle="collapse"
      data-target="#navbarCollapse"
      aria-controls="navbarCollapse"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">Beranda</a>
        </li>
        @if (Request::is('/'))            
        <li class="nav-item">
          <a href="#sedekahprioritas" class="nav-link d-inline-block">Sedekah Prioritas</a>
        </li>
        <li class="nav-item">
          <a href="#kategori" class="nav-link">Kategori</a>
        </li>
        @endif
        <li class="nav-item">
          @if (Route::has('login'))
            @auth
              @if (Auth::user()->role == "2")
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ Auth::user()->name }}</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li class="dropdown-divider"></li>
                    <li><a href="/user" class="dropdown-item nav-link {{ Request::is('user') ? 'active text-white' : ''}}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      Dashboard 
                    </a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="/user/fundraising" class="dropdown-item nav-link {{ Request::is('user/fundraising') ? 'active text-white' : ''}}">
                      <i class="nav-icon fas fa-bullhorn"></i>
                      Fundraising 
                    </a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="/user/profile" class="dropdown-item nav-link {{ Request::is('user/profile') ? 'active text-white' : ''}}">
                      <i class="nav-icon fas fa-user"></i>
                      Profil Saya 
                    </a></li>
                    <li class="dropdown-divider"></li>
                    <li><a href="/user/donation" class="dropdown-item nav-link {{ Request::is('user/donation') ? 'active text-white' : ''}}">
                      <i class="nav-icon fas fa-donate"></i>
                      Donasi Saya 
                    </a></li>
                    <li class="dropdown-divider"></li>
                    <li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form>
                      <a class="dropdown-item nav-link" href=" {{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          <i class="nav-icon fas fa-sign-out-alt">
                          </i>
                          Logout
                      </a>
                    </li>
                  </ul>
                </li>
              @else             
                <a href="{{ url('home') }}" class="nav-link">Dashboard</a>
              @endif
            @else
              <a href="{{ url('login') }}" class="nav-link">Login</a>
            @endauth
          @endif
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <input
            class="form-control form-control-navbar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>
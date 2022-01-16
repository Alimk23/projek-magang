<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="{{ url('/') }}" class="navbar-brand">
      <img
        src="{{ url('/img/logo.png') }}"
        alt="Hobi Sedekah"
        class="brand-image ml-4"
        style="opacity: 0.8;transform:scale(3,3)"
      />
      <p class="text-xs text-muted text-capitalize m-0 p-0" style="color:rgb(175, 175, 175) !important">#HidupBerkahBerlimpah</p>
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
          <a href="#sedekahprioritas" class="nav-link">Sedekah Prioritas</a>
        </li>
        <li class="nav-item">
          <a href="#kategori" class="nav-link">Kategori</a>
        </li>
        @endif
        <li class="nav-item">
          @if (Route::has('login'))
          @auth
            <a href="{{ url('home') }}" class="nav-link">Dashboard</a>
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
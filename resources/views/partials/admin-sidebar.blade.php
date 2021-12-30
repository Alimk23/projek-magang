
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
    
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item pb-3 mb-2">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm pt-4">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ url('assets_ui/adminlte/dist/img/AdminLTELogo.png') }}" alt="Hobi Sedekah" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><b>Hobi</b>Sedekah</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ url('img/default.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="/profile" class="d-block">Admin</a>
            </div>
          </div>
    
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin') }}" class="nav-link {{ ($data['title'] == "Dashboard") ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('campaign') }}" class="nav-link {{ ($data['title'] == "Campaign") ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-copy"></i>
                        <p>
                            Campaign
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('donation') }}" class="nav-link {{ ($data['title'] == "Donation") ? 'active' : ''}}">
                    <i class="px-1 fas fa-hand-holding-usd"></i>
                        <p>
                            Donation
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('profile') }}" class="nav-link {{ ($data['title'] == "Profile") ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
    
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

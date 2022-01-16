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
            <img src="{{ url('/img/logo.png') }}" alt="Hobi Sedekah" class="brand-image mt-2" style="opacity: .8;transform:scale(4,4);margin-left:3.3rem">
            <span class="brand-text font-weight-light" style="opacity: 1 !important; color: #343a40 !important;">..............</span>
            <p class="text-xs text-muted text-capitalize p-0" style="color:rgb(175, 175, 175) !important; margin:1.5rem 0rem -0.5rem 4.5rem">#HidupBerkahBerlimpah</p>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            @if (Storage::disk('public')->exists(getProfilePicture()))
                <img src="{{ Storage::disk('public')->url(getProfilePicture()) }}" class="img-circle elevation-2" alt="Profile Picture">
            @else
                <img src="/img/default.png" class="img-circle elevation-2" alt="Profile Picture">
            @endif
            </div>
            <div class="info">
              <a href="/superadmin/settings" class="d-block">{{ Auth::user()->name; }}</a>
            </div>
          </div>
    
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-uppercase">Main Menu</li>
                <li class="nav-item">
                    <a href="{{ url('superadmin') }}" class="nav-link {{ Request::is('superadmin') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/superadmin/analytics') }}" class="nav-link {{ Request::is('superadmin/analytics*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Analytics
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/superadmin/category') }}" class="nav-link {{ Request::is('superadmin/category*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-list"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        User Management
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/fundraiser') }}" class="nav-link {{ Request::is('superadmin/fundraiser*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Fundraiser
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/contributor') }}" class="nav-link {{ Request::is('superadmin/contributor*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Contributor
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/superadmin/withdraw') }}" class="nav-link {{ Request::is('superadmin/withdraw*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Withdraw Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/superadmin/campaign') }}" class="nav-link {{ Request::is('superadmin/campaign*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Campaign Management
                        </p>
                    </a>
                </li>

                <li class="nav-header text-uppercase">Payment Gateway</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-fw fa-university"></i>
                      <p>
                        Manual Transfer
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/bank') }}" class="nav-link {{ Request::is('superadmin/bank*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Bank Info
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/payment') }}" class="nav-link {{ Request::is('superadmin/payment*') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Payment Request
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-uppercase">Personal Menu</li>
                <li class="nav-item">
                    <a href="{{ url('/superadmin/settings') }}" class="nav-link {{ Request::is('superadmin/settings*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <li class="nav-item mb-5 pb-2">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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


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
            {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a> --}}
            {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item pb-3 mb-2">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm pt-4">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div> --}}
            {{-- </li> --}}
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
            <img src="{{ url('/img/logo.png') }}" alt="Hobi Sedekah" class="brand-image mt-2" style="opacity: .8;transform:scale(1.5,1.5);margin-left:1.9rem">
            <span class="brand-text font-weight-light" style="opacity: 1 !important; color: #343a40 !important;">..............</span>
            <p class="text-xs text-muted text-capitalize p-0" style="color:rgb(175, 175, 175) !important; margin:1.5rem 0rem -0.5rem 4.5rem">#HidupBerkahBerlimpah</p>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
            @if (Storage::disk('public')->exists(getProfilePicture()))
                <img src="{{ Storage::disk('public')->url(getProfilePicture()) }}" class="img-circle elevation-2 overflow-hidden" alt="Profile Picture">
            @else
                <img src="/img/default.png" class="img-circle elevation-2 overflow-hidden" alt="Profile Picture">
            @endif
            </div>
            <div class="info">
              <a href="/admin/profile" class="d-block">{{ Auth::user()->name; }}</a>
            </div>
          </div>
    
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-uppercase">Main Menu</li>
                <li class="nav-item">
                    <a href="{{ url('admin') }}" class="nav-link {{ Request::is('admin') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/campaign') }}" class="nav-link {{ Request::is('admin/campaign*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-copy"></i>
                        <p>
                            Campaign
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/donation') }}" class="nav-link {{ Request::is('admin/donation*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Donation
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/contributor') }}" class="nav-link {{ Request::is('admin/contributor*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Contributor
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/fundraiser') }}" class="nav-link {{ Request::is('admin/fundraiser*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user"></i>
                        <p>
                            Fundraiser
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/withdraw') }}" class="nav-link {{ Request::is('admin/withdraw*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Withdraw
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/customer-service') }}" class="nav-link {{ Request::is('admin/customer-service*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customer Service
                        </p>
                    </a>
                </li>
                
                <li class="nav-header text-uppercase">Personal Menu</li>
                <li class="nav-item">
                    <a href="{{ url('/admin/bank') }}" class="nav-link {{ Request::is('admin/bank*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-university"></i>
                        <p>
                            Bank Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/profile') }}" class="nav-link {{ Request::is('admin/profile*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-fw fa-user"></i>
                        <p>
                            Profile
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

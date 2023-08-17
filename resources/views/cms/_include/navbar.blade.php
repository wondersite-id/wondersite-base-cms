<header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
        </button>
        <span class="page-title">@yield('title') @yield('badge')</span>
        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img src="{{ asset('cms/images/user/undraw_profile_3.svg') }}" class="user-image rounded-circle" alt="User Image" />
                    <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a class="dropdown-link-item" href="{{ Auth::user()->isAdmin() ? route('administrators.show',  Auth::user()) : route('customers.show',  Auth::user())}}">
                            <i class="mdi mdi-account-outline"></i>
                            <span class="nav-text">My Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <br>
                            <center>
                             <button type="button" class="btn btn-danger btn-sm btn-pill" data-toggle="modal" data-target="#logoutModal">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </button>
                            </center>
                            <br>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

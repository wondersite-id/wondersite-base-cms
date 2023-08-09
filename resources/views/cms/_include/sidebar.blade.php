<div class="sidebar-left" data-simplebar style="height: 100%;">
    @if (Auth::user()->isAdmin())
    <ul class="nav sidebar-inner" id="sidebar-menu">
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="section-title">
            Website Management
        </li>
        <li class="{{ Request::is('features', 'features/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('features.index') }}">
                <i class="mdi mdi-hexagon-multiple"></i>
                <span class="nav-text">Features</span>
            </a>
        </li>
        <li class="{{ Request::is('seo', 'seo/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('features.index') }}">
                <i class="mdi mdi-cloud-search-outline"></i>
                <span class="nav-text">SEO</span>
            </a>
        </li>
        <li class="{{ Request::is('menus', 'menus/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('menus.index') }}">
                <i class="mdi mdi-menu-open"></i>
                <span class="nav-text">Menus</span>
            </a>
        </li>
        <li class="{{ Request::is('utilities', 'utilities/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('utilities.index', ['type' => 'home']) }}">
                <i class="mdi mdi-wrench"></i>
                <span class="nav-text">Utilities</span>
            </a>
        </li>
        <li class="section-title">
            Access Management
        </li>
        @php $isActive = Request::is('administrators', 'administrators/*', 'customers', 'customers/*'); @endphp
        <li class="has-sub {{ $isActive == true ? 'active expand' : '' }}" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user-sidebar" aria-expanded="false" aria-controls="user-sidebar">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">Users</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ $isActive == true ? 'show' : '' }}" id="user-sidebar"
                data-parent="#sidebar-menu">
                <div class="sub-menu">
                    <li class="{{ Request::is('administrators', 'administrators/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('administrators.index') }}">
                        <span class="nav-text">Admin</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('customers', 'customers/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('customers.index') }}">
                        <span class="nav-text">Customer</span>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
    @endif
</div>
<div class="sidebar-footer">
    <div class="sidebar-footer-content">
        <ul class="d-flex">
            <li>
                <a href="{{ Auth::user()->isAdmin() ? route('administrators.show',  Auth::user()) : route('customers.show',  Auth::user())}}" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a>
            </li>
            <li>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal" title="Profile settings"><i class="mdi mdi-logout"></i></a>
            </li>
        </ul>
    </div>
</div>
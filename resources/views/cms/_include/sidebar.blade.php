<div class="sidebar-left" data-simplebar style="height: 100%;">
    <ul class="nav sidebar-inner" id="sidebar-menu">
        <li class="{{ Request::is('cms/dashboard') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('cms.dashboard') }}">
                <i class="mdi mdi-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>

        @if(
            Gate::inspect('viewAny', App\Models\Feature::class)->allowed() ||
            Gate::inspect('viewAny', App\Models\Article::class)->allowed() ||
            Gate::inspect('viewAny', RalphJSmit\Laravel\SEO\Models\SEO::class)->allowed() ||
            Gate::inspect('viewAny', App\Models\Menu::class)->allowed() ||
            Gate::inspect('viewAny', App\Models\Utility::class)->allowed()
        )
        <li class="section-title">
            Website Management
        </li>
        @endif

        @can('viewAny', App\Models\Feature::class)
        <li class="{{ Request::is('cms/features', 'cms/features/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('cms.features.index') }}">
                <i class="mdi mdi-hexagon-multiple"></i>
                <span class="nav-text">Features</span>
            </a>
        </li>
        @endcan

        @can('viewAny', App\Models\Article::class)
        @php $isActive = Request::is('cms/articles', 'cms/articles/*', 'cms/article-types', 'cms/article-types/*'); @endphp
        <li class="has-sub {{ $isActive == true ? 'active expand' : '' }}" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#article-sidebar" aria-expanded="false" aria-controls="article-sidebar">
                <i class="mdi mdi-notebook"></i>
                <span class="nav-text">Article</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ $isActive == true ? 'show' : '' }}" id="article-sidebar"
                data-parent="#sidebar-menu">
                <div class="sub-menu">
                    <li class="{{ Request::is('cms/article-types', 'cms/article-types/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('cms.article-types.index') }}">
                        <span class="nav-text">Article Types</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/articles', 'cms/articles/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('cms.articles.index') }}">
                        <span class="nav-text">Articles</span>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
        @endcan

        @can('viewAny', RalphJSmit\Laravel\SEO\Models\SEO::class)
        <li class="{{ Request::is('cms/seos', 'cms/seos/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('cms.seos.index') }}">
                <i class="mdi mdi-cloud-search-outline"></i>
                <span class="nav-text">SEO</span>
            </a>
        </li>
        @endcan

        @can('viewAny', App\Models\Menu::class)
        <li class="{{ Request::is('cms/menus', 'cms/menus/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('cms.menus.index') }}">
                <i class="mdi mdi-menu-open"></i>
                <span class="nav-text">Menus</span>
            </a>
        </li>
        @endcan

        @can('viewAny', App\Models\Utility::class)
        <li class="{{ Request::is('cms/utilities', 'cms/utilities/*') ? 'active' : '' }}">
            <a class="sidenav-item-link" href="{{ route('cms.utilities.index', ['type' => 'home']) }}">
                <i class="mdi mdi-wrench"></i>
                <span class="nav-text">Utilities</span>
            </a>
        </li>
        @endcan

        <li class="section-title">
            Access Management
        </li>
        @php $isActive = Request::is('cms/administrators', 'cms/administrators/*', 'cms/customers', 'cms/customers/*'); @endphp
        <li class="has-sub {{ $isActive == true ? 'active expand' : '' }}" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user-sidebar" aria-expanded="false" aria-controls="user-sidebar">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">Users</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ $isActive == true ? 'show' : '' }}" id="user-sidebar"
                data-parent="#sidebar-menu">
                <div class="sub-menu">
                    @if (Auth::user()->isAdmin())
                    <li class="{{ Request::is('cms/administrators', 'cms/administrators/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('cms.administrators.index') }}">
                        <span class="nav-text">Admin</span>
                        </a>
                    </li>
                    @endif
                    <li class="{{ Request::is('cms/customers', 'cms/customers/*') ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('cms.customers.index') }}">
                        <span class="nav-text">Customer</span>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</div>
<div class="sidebar-footer">
    <div class="sidebar-footer-content">
        <ul class="d-flex">
            <li>
                <a href="{{ Auth::user()->isAdmin() ? route('cms.administrators.show',  Auth::user()) : route('cms.customers.show',  Auth::user())}}" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a>
            </li>
            <li>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal" title="Profile settings"><i class="mdi mdi-logout"></i></a>
            </li>
        </ul>
    </div>
</div>
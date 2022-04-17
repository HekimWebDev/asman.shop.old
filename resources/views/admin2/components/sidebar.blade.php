<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        {{-- <div class="sidebar-brand-icon">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-2">Ýakyndar</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Sell') }}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->segment(2) === 'orders' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Orders" aria-expanded="true"
           aria-controls="Orders">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>{{ __('Orders') }}</span>
        </a>
        <div id="Orders" class="collapse" aria-labelledby="headingTwo" data-parent="#Orders">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}"
                   href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.payment-types*') ? 'active' : '' }}"
                   href="{{ route('admin.payment-types.index') }}">{{ __('Payment types') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->segment(2) === 'catalog' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Catalog" aria-expanded="true"
           aria-controls="Catalog">
            <i class="fas fa-fw fa-store"></i>
            <span>{{ __('Catalog') }}</span>
        </a>
        <div id="Catalog" class="collapse" aria-labelledby="headingTwo" data-parent="#Catalog">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.brands*') ? 'active' : '' }}"
                   href="{{ route('admin.brands.index') }}">{{ __('Brands') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"
                   href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}"
                   href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.attributes*') ? 'active' : '' }}"
                   href="{{ route('admin.attributes.index') }}">{{ __('Attributes') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Users') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Improve') }}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->segment(2) === 'service' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Services" aria-expanded="true"
           aria-controls="Services">
            <i class="fas fa-fw fa-cogs"></i>
            <span>{{ __('Services') }}</span>
        </a>
        <div id="Services" class="collapse" aria-labelledby="headingTwo" data-parent="#Services">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.service.categories*') ? 'active' : '' }}"
                   href="{{ route('admin.service.categories.index') }}">{{ __('Categories') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.service.services*') ? 'active' : '' }}"
                   href="{{ route('admin.service.services.index') }}">{{ __('Services') }}</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->segment(2) === 'blog' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Blog" aria-expanded="true"
           aria-controls="Blog">
            <i class="far fa-fw fa-newspaper"></i>
            <span>{{ __('Blog') }}</span>
        </a>
        <div id="Blog" class="collapse" aria-labelledby="headingPages" data-parent="#Blog">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.blog.categories*') ? 'active' : '' }}"
                   href="{{ route('admin.blog.categories.index') }}">{{ __('Categories') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.blog.posts*') ? 'active' : '' }}"
                   href="{{ route('admin.blog.posts.index') }}">{{ __('Posts') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.blog.tags*') ? 'active' : '' }}"
                   href="{{ route('admin.blog.tags.index') }}">{{ __('Tags') }}</a>
                {{-- <a class="collapse-item {{ request()->routeIs('admin.blog.comments*') ? 'active' : '' }}"
                    href="{{ route('admin.blog.comments.index') }}">{{ __('Comments') }}</a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->segment(2) === 'design' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Design" aria-expanded="true"
           aria-controls="Design">
            <i class="fas fa-fw fa-desktop"></i>
            <span>{{ __('Design') }}</span>
        </a>
        <div id="Design" class="collapse" aria-labelledby="headingPages" data-parent="#Design">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}"
                   href="{{ route('admin.sliders.index') }}">{{ __('Sliders') }}</a>
                {{-- <a class="collapse-item {{ request()->routeIs('admin.banners*') ? 'active' : '' }}"
                    href="{{ route('admin.banners.edit', 1) }}">{{ __('Banner') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.logos*') ? 'active' : '' }}"
                    href="{{ route('admin.logos.edit', 1) }}">{{ __('Logo') }}</a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->segment(2) === 'modules' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Modules" aria-expanded="true"
           aria-controls="Modules">
            <i class="fas fa-fw fa-puzzle-piece"></i>
            <span>{{ __('Modules') }}</span>
        </a>
        <div id="Modules" class="collapse" aria-labelledby="headingPages" data-parent="#Modules">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.subscribers*') ? 'active' : '' }}"
                   href="{{ route('admin.subscribers.index') }}">{{ __('Subscribers') }}</a>
                {{-- <a class="collapse-item {{ request()->routeIs('admin.blocks*') ? 'active' : '' }}"
                    href="{{ route('admin.blocks.index') }}">{{ __('Blocks') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.desired-products*') ? 'active' : '' }}"
                    href="{{ route('admin.desired-products.index') }}">{{ __('Desired products') }}</a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->segment(2) === 'ad' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Ad" aria-expanded="true"
           aria-controls="Ad">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>{{ __('Ads') }}</span>
        </a>
        <div id="Ad" class="collapse" aria-labelledby="headingPages" data-parent="#Ad">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.ads*') ? 'active' : '' }}"
                   href="{{ route('admin.ads.index') }}">{{ __('Ads') }}</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->segment(2) === 'settings' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Setting" aria-expanded="true"
           aria-controls="Settings">
            <i class="fa fa-cog fa-fw"></i>
            <span>{{ __('Settings') }}</span>
        </a>
        <div id="Setting" class="collapse" aria-labelledby="headingPages" data-parent="#Setting">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.settings.contact*') ? 'active' : '' }}"
                   href="{{ route('admin.settings.contact.edit') }}">{{ __('Contact') }}</a>
                <a class="collapse-item {{ request()->routeIs('admin.settings.about_us*') ? 'active' : '' }}"
                   href="{{ route('admin.settings.about_us.edit') }}">{{ __('About us') }}</a>
            </div>
        </div>
    </li>


@role('supervisor')

<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Administration') }}
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.admins.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Admins') }}</span></a>
    </li>

    @endrole

    <hr class="sidebar-divider">

{{--
<!-- Heading -->
<div class="sidebar-heading">
    Configure
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ShopParameters" aria-expanded="true"
        aria-controls="ShopParameters">
        <i class="fas fa-fw fa-cog"></i>
        <span>Shop Parameters</span>
    </a>
    <div id="ShopParameters" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block"> --}}

<!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

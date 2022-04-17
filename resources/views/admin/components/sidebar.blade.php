<aside class="main-sidebar sidebar-dark-indigo elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/img/avatar5.png') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->fullName ?? '' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{--Dashboard--}}
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                       class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-header">{{ __('Sell') }}</li>

                {{--Orders--}}
                <li class="nav-item mb-2 {{ request()->segment(2) === 'order' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'order' ? 'menu-is-opening menu-open active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ __('Orders') }}
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}"
                               class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Orders') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payment-types.index') }}"
                               class="nav-link {{ request()->routeIs('admin.payment-types*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Payment types') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Catalog --}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'catalog' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            {{ __('Catalog') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.index') }}"
                               class="nav-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Brands') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}"
                               class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Categories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}"
                               class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Products') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.attributes.index') }}"
                               class="nav-link {{ request()->routeIs('admin.attributes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Attributes') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Users--}}
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __('Users') }}</p>
                    </a>
                </li>

                <li class="nav-header">{{ __('Improve') }}</li>

                {{--Services--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'service' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ __('Services') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.service.categories.index') }}"
                               class="nav-link {{ request()->routeIs('admin.service.categories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Categories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.service.categories.index') }}"
                               class="nav-link {{ request()->routeIs('admin.service.services*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{  __('Services')  }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Blog--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'blog' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            {{ __('Blog') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.categories.index') }}"
                               class="nav-link {{ request()->routeIs('admin.blog.categories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Categories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.posts.index') }}"
                               class="nav-link {{ request()->routeIs('admin.blog.posts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{  __('Posts')  }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.tags.index') }}"
                               class="nav-link {{ request()->routeIs('admin.blog.tags*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{  __('Posts')  }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Design--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'design' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            {{ __('Design') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sliders.index') }}"
                               class="nav-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Sliders') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Modules--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'modules' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>
                            {{ __('Modules') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.subscribers.index') }}"
                               class="nav-link {{ request()->routeIs('admin.subscribers*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Subscribers') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Ads--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'ad' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            {{ __('Ads') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.index') }}"
                               class="nav-link {{ request()->routeIs('admin.ads*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Subscribers') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Settings--}}
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ request()->segment(2) === 'settings' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog fa-fw"></i>
                        <p>
                            {{ __('Settings') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.contact.edit') }}"
                               class="nav-link {{ request()->routeIs('admin.settings.contact*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Contact') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.about_us.edit') }}"
                               class="nav-link {{ request()->routeIs('admin.settings.about_us.edit*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{  __('About us')  }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

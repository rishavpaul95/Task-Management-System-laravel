<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Web Task LTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @auth
                    <a href="#" class="d-block">
                        {{ Auth::user()->name }}</a>
                @endauth
                @guest
                    <a href="#" class="d-block">Guest</a>
                @endguest
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"
                    disabled>
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Welcome</p>
                    </a>
                </li>
                @auth


                    <li class="nav-item menu-open">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User-Panel
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/dash') }}" class="nav-link {{ request()->is('dash') ? 'active' : '' }}">
                                    <i class="fa fa-tachometer-alt nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/profile') }}"
                                    class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                                    <i class="far fa-address-card nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/alltask') }}"
                                    class="nav-link {{ request()->is('alltask') ? 'active' : '' }}">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Task Board</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/assigntask') }}"
                                    class="nav-link {{ request()->is('assigntask') ? 'active' : '' }}">
                                    <i class="fa fa-share nav-icon"></i>
                                    <p>Assign Task</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->input('categoryFilter') ? 'menu-open' : '' }}">
                                <a href="javascript:void(0)" class="nav-link">
                                    <i class="fa-solid fa-diagram-project nav-icon"></i>
                                    <p>
                                        Projects
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{ url('/tasks?categoryFilter=' . $category->id) }}"
                                                class="nav-link {{ request()->input('categoryFilter') == $category->id ? 'active' : '' }}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>{{ $category->category }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </li>

                    @role('admin')
                        <li class="nav-item menu-open">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Admin-Panel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview menu-open">
                                <li class="nav-item">
                                    <a href="{{ url('/categories') }}"
                                        class="nav-link {{ request()->is('categories') ? 'active' : '' }}">
                                        <i class="fa-solid fa-layer-group sm-nav-icon"></i>
                                        <p>Categories Control</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('permissions', 'roles') ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link">
                                        <i class="fa-solid fa-check nav-icon"></i>
                                        <p>
                                            Roles/Permissions
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/permissions') }}"
                                                class="nav-link {{ request()->is('permissions') ? 'active' : '' }}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Permissions Control</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/roles') }}"
                                                class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Roles Control</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/users') }}"
                                        class="nav-link {{ request()->is('/users') ? 'active' : '' }}">
                                        <i class="fa-solid fa-users nav-icon"></i>
                                        <p>Users Control</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endrole

                @endauth
                <li class="nav-header">------------------------------</li>
                <li class="nav-item">
                    <a href="{{ url('/blog') }}" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>Contact</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->


</aside>

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
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
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
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/demo') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/tasks') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>My Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/assigntask') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assign Task</p>
                                </a>
                            </li>
                            @if (auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a href="{{ url('/admin/categories') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories Control</p>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                </li>
                <li class="nav-header">------------------------------</li>
                <li class="nav-item">
                    <a href="{{ url('/blog') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/contact') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope "></i>
                        <p>Contact</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

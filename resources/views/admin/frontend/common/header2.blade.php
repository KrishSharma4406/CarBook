<!-- Main Sidebar Container -->
<style>
  /* Active tab */
  .nav-sidebar .nav-link.active {
    background-color: #007bff !important;
    color: #fff !important;
    border-radius: 6px;
  }

  .nav-sidebar .nav-link.active i,
  .nav-sidebar .nav-link.active p {
    color: #fff !important;
  }

  /* Inactive tabs */
  .nav-sidebar .nav-link {
    color: #c2c7d0 !important;
  }

  .nav-sidebar .nav-link:hover {
    background-color: #495057;
    color: #fff !important;
  }

  .brand-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
  }

  .user-panel {
    border-bottom: 1px solid rgba(255, 255, 255, .1);
  }

  .user-panel img {
    border: 3px solid #007bff;
  }

  .user-panel h6 {
    font-weight: 600;
  }

  .user-panel .btn {
    border-radius: 6px;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.home') }}" class="brand-link text-center">
    @php
      $admin = Auth::guard('admin')->user();
    @endphp

    <img src="{{ !empty($admin->profile_image)
  ? asset('uploads/adminimg/' . $admin->profile_image)
  : asset('UI/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" width="120" height="120"
      style="object-fit:cover;">

    <span class="brand-text font-weight-bold">
      CarBook Admin
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ $admin->profile_image
  ? asset('uploads/adminimg/' . $admin->profile_image)
  : asset('UI/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" width="120" height="120"
          style="object-fit:cover;">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ $admin->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @can('dashboard.view')
          <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
        @endcan

        @can('forms.view')
          <li class="nav-item">
            <a href="{{ route('admin.forms') }}" class="nav-link {{ request()->routeIs('admin-forms') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Forms</p>
            </a>
          </li>
        @endcan

        @can('tables.view')
          <li class="nav-item">
            <a href="{{ route('admin.tables') }}"
              class="nav-link {{ request()->routeIs('admin.tables') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tables</p>
            </a>
          </li>
        @endcan

        @can('users.view')
          <li class="nav-item">

            <a href="{{ route('admin-users') }}" class="nav-link">

              <i class="nav-icon fas fa-users"></i>

              <p>Users</p>

            </a>

          </li>
        @endcan

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="bi bi-three-dots-vertical"></i>
            <p>
              User page
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.homepage.index') }}"
                class="nav-link {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.about.index') }}"
                class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>About</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.services.index') }}"
                class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.blog.index') }}"
                class="nav-link {{ request()->routeIs('admin.blog.*') && !request()->routeIs('blog-posts.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>Blogs (Header)</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('blog-posts.index') }}"
                class="nav-link {{ request()->routeIs('blog-posts.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>Blog Posts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.contact.index') }}"
                class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-bar-right"></i>
                <p>Contacts</p>
              </a>
            </li>
          </ul>
        </li>

        @can('cars.view')
          <li class="nav-item">
            <a href="{{ route('cars.index') }}" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>Cars</p>
            </a>
          </li>
        @endcan

        @can('rides.view')
          <li class="nav-item">
            <a href="{{ route('admin.rides.index') }}"
              class="nav-link {{ request()->routeIs('admin.rides.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-road"></i>
              <p>Rides</p>
            </a>
          </li>
        @endcan

        @can('bookings.view')
          <li class="nav-item">
            <a href="{{ route('admin.bookings.index') }}"
              class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>Bookings</p>
            </a>
          </li>
        @endcan

        <a href="{{ route('admin.profile.index') }}" class="btn btn-sm btn-primary btn-block mb-2">
          <i class="fas fa-user"></i>
          My Profile
        </a>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf

          <button class="btn btn-sm btn-danger btn-block">
            <i class="fas fa-sign-out-alt"></i>
            Logout
          </button>
        </form>

        <li class="nav-header">
          ACCESS CONTROL
        </li>

        @can('roles.view')
          <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Roles</p>
            </a>
          </li>
        @endcan
        @can('permissions.view')
          <li class="nav-item">
            <a href="{{ route('permissions.index') }}"
              class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-lock"></i>
              <p>Permissions</p>
            </a>
          </li>
        @endcan
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
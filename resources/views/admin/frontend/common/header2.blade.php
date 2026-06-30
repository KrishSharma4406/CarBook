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
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ asset('UI/admin/index3.html') }}" class="brand-link">
    <img src="{{ asset('UI/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('UI/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
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
      <ul class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false">

        <li class="nav-item">
          <a href="{{ route('admin-home') }}"
            class="nav-link {{ request()->routeIs('admin-home') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin-forms') }}"
            class="nav-link {{ request()->routeIs('admin-forms') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Forms</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin-tabels') }}"
            class="nav-link {{ request()->routeIs('admin-tabels') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tables</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin-users') }}"
            class="nav-link {{ request()->routeIs('admin-users') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Users</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.cars.index') }}" class="nav-link">
            <i class="nav-icon fas fa-car"></i>
            <p>Cars</p>
          </a>
        </li>

        <li class="nav-item">

          <a href="{{ route('admin.rides.index') }}"
            class="nav-link {{ request()->routeIs('admin.rides.*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-road"></i>

            <p>

              Rides

            </p>

          </a>

        </li>

        <li class="nav-item">

          <a href="{{ route('admin.bookings.index') }}"
            class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-book"></i>

            <p>

              Bookings

            </p>

          </a>

        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      @php
        // Real notifications queries
        $pendingDrivers = \App\Models\DriverApplication::where('status', 'pending')->latest()->first();
        $pendingDriversCount = \App\Models\DriverApplication::where('status', 'pending')->count();

        $unreadDriverMsgs = \App\Models\DriverApplicationMessage::where('sender_type', 'driver')->where('is_read', false)->latest()->first();
        $unreadDriverMsgsCount = \App\Models\DriverApplicationMessage::where('sender_type', 'driver')->where('is_read', false)->count();

        $recentContacts = \App\Models\ContactMessage::latest()->first();
        $recentContactsCount = \App\Models\ContactMessage::where('created_at', '>=', now()->subDays(3))->count();

        $recentBookings = \App\Models\RideBooking::latest()->first();
        $recentBookingsCount = \App\Models\RideBooking::where('created_at', '>=', now()->subDays(3))->count();

        $recentUsers = \App\Models\User::latest()->first();
        $recentUsersCount = \App\Models\User::where('created_at', '>=', now()->subDays(3))->count();

        $totalNotifications = $pendingDriversCount + $unreadDriverMsgsCount + $recentContactsCount + $recentBookingsCount + $recentUsersCount;
      @endphp

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Notifications">
          <i class="far fa-bell"></i>
          @if($totalNotifications > 0)
            <span class="badge badge-warning navbar-badge font-weight-bold">{{ $totalNotifications > 99 ? '99+' : $totalNotifications }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 310px;">
          @if($totalNotifications > 0)
            <span class="dropdown-item dropdown-header font-weight-bold text-dark">
              {{ $totalNotifications }} {{ Str::plural('Notification', $totalNotifications) }}
            </span>
            <div class="dropdown-divider"></div>

            @if($unreadDriverMsgsCount > 0)
              <a href="{{ route('driver-applications.index') }}" class="dropdown-item py-2">
                <i class="fas fa-comments text-primary mr-2"></i> {{ $unreadDriverMsgsCount }} new driver {{ Str::plural('message', $unreadDriverMsgsCount) }}
                <span class="float-right text-muted text-sm">{{ $unreadDriverMsgs ? $unreadDriverMsgs->created_at->diffForHumans(null, true) : '' }}</span>
              </a>
              <div class="dropdown-divider"></div>
            @endif

            @if($pendingDriversCount > 0)
              <a href="{{ route('driver-applications.index', ['status' => 'pending']) }}" class="dropdown-item py-2">
                <i class="fas fa-id-card text-warning mr-2"></i> {{ $pendingDriversCount }} pending driver {{ Str::plural('application', $pendingDriversCount) }}
                <span class="float-right text-muted text-sm">{{ $pendingDrivers ? $pendingDrivers->created_at->diffForHumans(null, true) : '' }}</span>
              </a>
              <div class="dropdown-divider"></div>
            @endif

            @if($recentContactsCount > 0)
              <a href="{{ route('contact-messages.index') }}" class="dropdown-item py-2">
                <i class="fas fa-envelope text-info mr-2"></i> {{ $recentContactsCount }} customer {{ Str::plural('inquiry', $recentContactsCount) }}
                <span class="float-right text-muted text-sm">{{ $recentContacts ? $recentContacts->created_at->diffForHumans(null, true) : '' }}</span>
              </a>
              <div class="dropdown-divider"></div>
            @endif

            @if($recentBookingsCount > 0)
              <a href="{{ route('admin.bookings.index') }}" class="dropdown-item py-2">
                <i class="fas fa-book text-success mr-2"></i> {{ $recentBookingsCount }} recent ride {{ Str::plural('booking', $recentBookingsCount) }}
                <span class="float-right text-muted text-sm">{{ $recentBookings ? $recentBookings->created_at->diffForHumans(null, true) : '' }}</span>
              </a>
              <div class="dropdown-divider"></div>
            @endif

            @if($recentUsersCount > 0)
              <a href="{{ route('admin-users') }}" class="dropdown-item py-2">
                <i class="fas fa-user-plus text-secondary mr-2"></i> {{ $recentUsersCount }} new registered {{ Str::plural('user', $recentUsersCount) }}
                <span class="float-right text-muted text-sm">{{ $recentUsers ? $recentUsers->created_at->diffForHumans(null, true) : '' }}</span>
              </a>
              <div class="dropdown-divider"></div>
            @endif

            <a href="{{ route('admin.home') }}" class="dropdown-item dropdown-footer text-center font-weight-bold text-primary">View Dashboard</a>
          @else
            <span class="dropdown-item dropdown-header text-muted">No New Notifications</span>
            <div class="dropdown-divider"></div>
            <div class="dropdown-item text-center py-4 text-muted">
              <i class="far fa-bell-slash fa-2x mb-2 d-block text-secondary"></i>
              <p class="mb-0 font-weight-bold">All caught up!</p>
              <small>No pending items or unread messages.</small>
            </div>
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.home') }}" class="dropdown-item dropdown-footer text-center">Dashboard</a>
          @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

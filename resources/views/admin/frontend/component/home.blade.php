@can('dashboard.view')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
        <!-- Live indicator -->
        <div class="row">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <span class="badge badge-success mr-2" id="live-indicator" style="animation: pulse 2s infinite;">
                <i class="fas fa-circle mr-1" style="font-size: 8px;"></i> LIVE
              </span>
              <small class="text-muted">Auto-refreshing every 10 seconds &middot; Last updated: <span id="last-updated-time">{{ $lastUpdated ?? now()->format('H:i:s') }}</span></small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        {{-- ───────────── STAT BOXES ROW ───────────── --}}
        <div class="row">
          {{-- Total Users --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="stat-total-users">{{ $totalUsers }}</h3>
                <p>Total Users</p>
              </div>
              <div class="icon"><i class="fas fa-users"></i></div>
              <a href="{{ route('admin-users') }}" class="small-box-footer">
                Manage Users <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Total Cars --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="stat-total-cars">{{ $totalCars }}</h3>
                <p>Total Cars</p>
              </div>
              <div class="icon"><i class="fas fa-car"></i></div>
              <a href="{{ route('cars.index') }}" class="small-box-footer">
                Manage Cars <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Total Rides --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="stat-total-rides">{{ $totalRides }}</h3>
                <p>Total Rides</p>
              </div>
              <div class="icon"><i class="fas fa-road"></i></div>
              <a href="{{ route('admin.rides.index') }}" class="small-box-footer">
                View Rides <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Total Bookings --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="stat-total-bookings">{{ $totalBookings }}</h3>
                <p>Total Bookings</p>
              </div>
              <div class="icon"><i class="fas fa-book"></i></div>
              <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">
                View Bookings <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>

        {{-- ───────────── SECONDARY STAT BOXES ───────────── --}}
        <div class="row">
          {{-- Ride Bookings --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-indigo">
              <div class="inner">
                <h3 id="stat-total-ride-bookings">{{ $totalRideBookings }}</h3>
                <p>Ride Bookings</p>
              </div>
              <div class="icon"><i class="fas fa-ticket-alt"></i></div>
              <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Contact Messages --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-teal">
              <div class="inner">
                <h3 id="stat-total-messages">{{ $totalContactMessages }}</h3>
                <p>Contact Messages</p>
              </div>
              <div class="icon"><i class="fas fa-envelope"></i></div>
              <a href="{{ route('contact-messages.index') }}" class="small-box-footer">
                View Messages <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Blog Posts --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-orange">
              <div class="inner">
                <h3 id="stat-total-blog-posts">{{ $totalBlogPosts }}</h3>
                <p>Blog Posts</p>
              </div>
              <div class="icon"><i class="fas fa-blog"></i></div>
              <a href="{{ route('blog-posts.index') }}" class="small-box-footer">
                Manage Posts <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          {{-- Revenue --}}
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-dark">
              <div class="inner">
                <h3>₹<span id="stat-total-revenue">{{ number_format($totalRevenue, 0) }}</span></h3>
                <p>Total Revenue</p>
              </div>
              <div class="icon"><i class="fas fa-rupee-sign"></i></div>
              <span class="small-box-footer">
                This Month: ₹<span id="stat-revenue-this-month">{{ number_format($revenueThisMonth, 0) }}</span>
              </span>
            </div>
          </div>
        </div>

        {{-- ───────────── GROWTH INDICATORS ───────────── --}}
        <div class="row">
          <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-plus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">New Users This Month</span>
                <span class="info-box-number" id="stat-users-this-month">{{ $usersThisMonth }}</span>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar bg-info" style="width: {{ min(100, max(5, $usersThisMonth * 10)) }}%"></div>
                </div>
                <span class="progress-description" id="stat-user-change">
                  @if($userChange >= 0)
                    <i class="fas fa-arrow-up text-success"></i> {{ $userChange }}% vs last month
                  @else
                    <i class="fas fa-arrow-down text-danger"></i> {{ abs($userChange) }}% vs last month
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bookings This Month</span>
                <span class="info-box-number" id="stat-bookings-this-month">{{ $bookingsThisMonth }}</span>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar bg-danger" style="width: {{ min(100, max(5, $bookingsThisMonth * 10)) }}%"></div>
                </div>
                <span class="progress-description" id="stat-booking-change">
                  @if($bookingChange >= 0)
                    <i class="fas fa-arrow-up text-success"></i> {{ $bookingChange }}% vs last month
                  @else
                    <i class="fas fa-arrow-down text-danger"></i> {{ abs($bookingChange) }}% vs last month
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-route"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Rides This Month</span>
                <span class="info-box-number" id="stat-rides-this-month">{{ $ridesThisMonth }}</span>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar bg-warning" style="width: {{ min(100, max(5, $ridesThisMonth * 10)) }}%"></div>
                </div>
                <span class="progress-description" id="stat-ride-change">
                  @if($rideChange >= 0)
                    <i class="fas fa-arrow-up text-success"></i> {{ $rideChange }}% vs last month
                  @else
                    <i class="fas fa-arrow-down text-danger"></i> {{ abs($rideChange) }}% vs last month
                  @endif
                </span>
              </div>
            </div>
          </div>
        </div>

        {{-- ───────────── CHARTS ROW ───────────── --}}
        <div class="row">
          {{-- Monthly Trends Line Chart --}}
          <section class="col-lg-8">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  Monthly Trends (Last 6 Months)
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="monthlyTrendsChart" style="min-height: 300px; height: 300px; max-height: 300px;"></canvas>
              </div>
            </div>
          </section>

          {{-- Booking Status Doughnut --}}
          <section class="col-lg-4">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Booking Status
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="bookingStatusChart" style="min-height: 300px; height: 300px; max-height: 300px;"></canvas>
              </div>
            </div>
          </section>
        </div>

        {{-- ───────────── SECOND CHARTS ROW ───────────── --}}
        <div class="row">
          {{-- Ride Status Chart --}}
          <section class="col-lg-4">
            <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-bar mr-1"></i>
                  Ride Status
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="rideStatusChart" style="min-height: 250px; height: 250px; max-height: 250px;"></canvas>
              </div>
            </div>
          </section>

          {{-- Ride Booking Status Chart --}}
          <section class="col-lg-4">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Ride Booking Status
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="rideBookingStatusChart" style="min-height: 250px; height: 250px; max-height: 250px;"></canvas>
              </div>
            </div>
          </section>

          {{-- Top Cars --}}
          <section class="col-lg-4">
            <div class="card card-outline card-danger">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-trophy mr-1"></i>
                  Top Cars by Bookings
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped table-sm" id="top-cars-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Car</th>
                      <th>Brand</th>
                      <th>Bookings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($topCars as $i => $car)
                    <tr>
                      <td>{{ $i + 1 }}</td>
                      <td>{{ $car->car_name }}</td>
                      <td>{{ $car->brand }}</td>
                      <td><span class="badge badge-primary">{{ $car->bookings_count }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">No cars found</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>

        {{-- ───────────── TABLES ROW ───────────── --}}
        <div class="row">
          {{-- Recent Users --}}
          <div class="col-lg-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-clock mr-1"></i> Recent Users</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-hover table-sm" id="recent-users-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Joined</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentUsers as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td><small>{{ $user->email }}</small></td>
                      <td>
                        @if($user->status === 'active' || $user->status === null)
                          <span class="badge badge-success">Active</span>
                        @else
                          <span class="badge badge-danger">{{ ucfirst($user->status) }}</span>
                        @endif
                      </td>
                      <td><small>{{ $user->created_at->diffForHumans() }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">No users yet</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <a href="{{ route('admin-users') }}" class="text-primary">View All Users</a>
              </div>
            </div>
          </div>

          {{-- Recent Bookings --}}
          <div class="col-lg-6">
            <div class="card card-outline card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock mr-1"></i> Recent Bookings</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-hover table-sm" id="recent-bookings-table">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Car</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                      <td>{{ $booking->user->name ?? 'N/A' }}</td>
                      <td>{{ $booking->car->car_name ?? 'N/A' }}</td>
                      <td>₹{{ number_format($booking->total_amount, 0) }}</td>
                      <td>
                        @php
                          $statusColors = [
                            'confirmed' => 'success', 'pending' => 'warning',
                            'cancelled' => 'danger', 'completed' => 'info'
                          ];
                          $color = $statusColors[$booking->status] ?? 'secondary';
                        @endphp
                        <span class="badge badge-{{ $color }}">{{ ucfirst($booking->status) }}</span>
                      </td>
                      <td><small>{{ $booking->created_at->diffForHumans() }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">No bookings yet</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <a href="{{ route('admin.bookings.index') }}" class="text-danger">View All Bookings</a>
              </div>
            </div>
          </div>
        </div>

        {{-- ───────────── RECENT RIDES + MESSAGES ───────────── --}}
        <div class="row">
          {{-- Recent Rides --}}
          <div class="col-lg-6">
            <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-car-side mr-1"></i> Recent Rides</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-hover table-sm" id="recent-rides-table">
                  <thead>
                    <tr>
                      <th>Driver</th>
                      <th>From → To</th>
                      <th>Date</th>
                      <th>Fare</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentRides as $ride)
                    <tr>
                      <td>{{ $ride->user->name ?? 'N/A' }}</td>
                      <td><small>{{ Str::limit($ride->pickup_location, 12) }} → {{ Str::limit($ride->destination, 12) }}</small></td>
                      <td><small>{{ \Carbon\Carbon::parse($ride->travel_date)->format('d M') }}</small></td>
                      <td>₹{{ $ride->fare }}</td>
                      <td>
                        @php
                          $rideColors = ['active' => 'success', 'completed' => 'info', 'cancelled' => 'danger'];
                          $rc = $rideColors[$ride->status] ?? 'secondary';
                        @endphp
                        <span class="badge badge-{{ $rc }}">{{ ucfirst($ride->status) }}</span>
                      </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">No rides yet</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <a href="{{ route('admin.rides.index') }}" class="text-warning">View All Rides</a>
              </div>
            </div>
          </div>

          {{-- Recent Contact Messages --}}
          <div class="col-lg-6">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-envelope-open-text mr-1"></i> Recent Contact Messages</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-hover table-sm" id="recent-messages-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Received</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentMessages as $msg)
                    <tr>
                      <td>{{ $msg->name }}</td>
                      <td><small>{{ Str::limit($msg->subject, 30) }}</small></td>
                      <td><small>{{ $msg->created_at->diffForHumans() }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted">No messages yet</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <a href="{{ route('contact-messages.index') }}" class="text-info">View All Messages</a>
              </div>
            </div>
          </div>
        </div>

        {{-- ───────────── CHAT PRIVACY NOTICE ───────────── --}}
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-secondary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-shield-alt mr-1"></i>
                  Chat Privacy
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body text-center py-5">
                <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">User Chats Are Private</h5>
                <p class="text-muted mb-0">
                  Chat conversations between users are end-to-end private and are not accessible from the admin panel.
                  <br>
                  This ensures user privacy and data protection compliance.
                </p>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<style>
  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }

  .stat-flash {
    animation: statFlash 0.6s ease-in-out;
  }

  @keyframes statFlash {
    0% { color: inherit; }
    50% { color: #28a745; transform: scale(1.1); }
    100% { color: inherit; transform: scale(1); }
  }

  .small-box {
    transition: transform 0.2s ease-in-out;
  }

  .small-box:hover {
    transform: translateY(-3px);
  }

  .info-box {
    transition: box-shadow 0.2s ease-in-out;
  }

  .info-box:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
  }
</style>
@endcan
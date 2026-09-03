
<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 text-center mb-5">
                <h1 class="mb-2 bread text-white">
                    Driver Dashboard
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="ftco-section bg-light">
    <div class="container">

        <!-- ================= OVERVIEW ================= -->

        <div class="card shadow mb-5">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fa fa-tachometer mr-2"></i>
                    Welcome, {{ auth()->user()->name }}
                </h4>
            </div>

            <div class="card-body">

                <p class="text-muted mb-4">Here's an overview of your ride activity.</p>

                <div class="row">

                    <div class="col-lg-3 col-md-6 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100 text-center" style="border-top: 4px solid #01d28e !important;">
                            <div class="card-body py-4">
                                <span class="icon-steering_wheel d-block mb-2" style="font-size:28px; color:#01d28e;"></span>
                                <h2 class="mb-1" style="font-weight:700;">{{ $totalRides }}</h2>
                                <small class="text-muted text-uppercase" style="letter-spacing:.5px; font-weight:600; font-size:11px;">Total Rides</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100 text-center" style="border-top: 4px solid #ffc107 !important;">
                            <div class="card-body py-4">
                                <span class="icon-clock-o d-block mb-2" style="font-size:28px; color:#ffc107;"></span>
                                <h2 class="mb-1" style="font-weight:700;">{{ $pendingRequests ?? 0 }}</h2>
                                <small class="text-muted text-uppercase" style="letter-spacing:.5px; font-weight:600; font-size:11px;">Pending</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100 text-center" style="border-top: 4px solid #1089ff !important;">
                            <div class="card-body py-4">
                                <span class="icon-car d-block mb-2" style="font-size:28px; color:#1089ff;"></span>
                                <h2 class="mb-1" style="font-weight:700;">{{ $activeRides }}</h2>
                                <small class="text-muted text-uppercase" style="letter-spacing:.5px; font-weight:600; font-size:11px;">Active Rides</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100 text-center" style="border-top: 4px solid #6f42c1 !important;">
                            <div class="card-body py-4">
                                <span class="icon-check_circle d-block mb-2" style="font-size:28px; color:#6f42c1;"></span>
                                <h2 class="mb-1" style="font-weight:700;">{{ $completedRides }}</h2>
                                <small class="text-muted text-uppercase" style="letter-spacing:.5px; font-weight:600; font-size:11px;">Completed</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100 text-center" style="border-top: 4px solid #6c757d !important;">
                            <div class="card-body py-4">
                                <i class="fa fa-history d-block mb-2" style="font-size:28px; color:#6c757d;"></i>
                                <h2 class="mb-1" style="font-weight:700;">{{ $expiredRides }}</h2>
                                <small class="text-muted text-uppercase" style="letter-spacing:.5px; font-weight:600; font-size:11px;">Expired</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- ================= RECENT RIDES ================= -->

        <div class="card shadow mb-5">

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">
                    <i class="fa fa-road mr-2"></i>
                    Recent Rides
                </h4>
                <a href="{{ route('rides.my') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-list"></i>
                    View All
                </a>
            </div>

            <div class="card-body">

                @if($recentRides->count())

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Fare</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRides as $ride)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $ride->pickup_location }}
                                    <i class="fa fa-arrow-right mx-2 text-success"></i>
                                    {{ $ride->destination }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}
                                </td>
                                <td>
                                    ₹{{ number_format($ride->fare) }}
                                </td>
                                <td>
                                    @if($ride->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($ride->status == 'completed')
                                        <span class="badge badge-info">Completed</span>
                                    @elseif($ride->status == 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @elseif($ride->status == 'expired')
                                        <span class="badge badge-secondary"><i class="fa fa-clock-o mr-1"></i>Expired</span>
                                    @else
                                        <span class="badge badge-warning">{{ ucfirst($ride->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else

                <div class="text-center py-5">
                    <i class="fa fa-car fa-4x text-muted mb-3"></i>
                    <h4>No Rides Offered Yet</h4>
                    <p>Start offering rides and help others travel while earning money.</p>
                    <a href="{{ route('offer.ride') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Offer Your First Ride
                    </a>
                </div>

                @endif

            </div>

        </div>

        <!-- ================= RECENT BOOKING REQUESTS ================= -->

        @if($recentRequests->count())
        <div class="card shadow mb-5">

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">
                    <i class="fa fa-bell mr-2"></i>
                    Recent Booking Requests
                </h4>
                <a href="{{ route('rides.requests') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-list"></i>
                    View All
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Passenger</th>
                                <th>Ride</th>
                                <th>Seats</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRequests as $req)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $req->user->name }}</strong>
                                </td>
                                <td>
                                    {{ $req->ride->pickup_location }}
                                    <i class="fa fa-arrow-right mx-2 text-muted"></i>
                                    {{ $req->ride->destination }}
                                </td>
                                <td>{{ $req->seats }}</td>
                                <td>
                                    @if($req->booking_status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($req->booking_status == 'accepted')
                                        <span class="badge badge-success">Accepted</span>
                                    @elseif($req->booking_status == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @elseif($req->booking_status == 'cancelled')
                                        <span class="badge badge-secondary">Cancelled</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($req->booking_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        @endif

        <!-- ================= QUICK ACTIONS ================= -->

        <div class="card shadow">

            <div class="card-header bg-dark text-white">
                <h4 class="mb-0 text-white">
                    <i class="fa fa-flash mr-2"></i>
                    Quick Actions
                </h4>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('offer.ride') }}" class="btn btn-success btn-block py-3">
                            <i class="fa fa-plus mr-2"></i>
                            Offer a Ride
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('rides.my') }}" class="btn btn-primary btn-block py-3">
                            <i class="fa fa-car mr-2"></i>
                            My Rides
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('rides.requests') }}" class="btn btn-warning btn-block py-3" style="color:#fff;">
                            <i class="fa fa-bell mr-2"></i>
                            Ride Requests
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('booking.my') }}" class="btn btn-info btn-block py-3">
                            <i class="fa fa-suitcase mr-2"></i>
                            My Bookings
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('chat.index') }}" class="btn btn-secondary btn-block py-3">
                            <i class="fa fa-comments mr-2"></i>
                            Messages
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-dark btn-block py-3">
                            <i class="fa fa-user mr-2"></i>
                            Edit Profile
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

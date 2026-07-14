<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{route('about')}}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{route('service')}}" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="{{route('price')}}" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="{{route('car')}}" class="nav-link">Cars</a></li>
                <li class="nav-item"><a href="{{route('blog')}}" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">

                @if(Auth::check())

                    <style>
                        /* Notification Badge Top styling */
                        .profile-avatar-container {
                            position: relative;
                            display: inline-block;
                        }

                        .notification-badge-top {
                            position: absolute;
                            top: -5px;
                            right: -5px;
                            background-color: #ff3b30;
                            color: #ffffff;
                            border-radius: 50%;
                            padding: 2px 6px;
                            font-size: 10px;
                            font-weight: bold;
                            line-height: 1;
                            border: 1.5px solid #ffffff;
                            z-index: 10;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
                        }

                        /* Hover trigger for Profile Dropdown on Desktop */
                        @media (min-width: 992px) {
                            .nav-item.dropdown:hover .dropdown-menu {
                                display: block;
                                opacity: 1;
                                visibility: visible;
                                margin-top: 0;
                            }
                        }
                    </style>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <div class="profile-avatar-container mr-2">
                                <div class="profile-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                @if(isset($totalUnreadCount) && $totalUnreadCount > 0)
                                    <span class="notification-badge-top">{{ $totalUnreadCount }}</span>
                                @endif
                            </div>

                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right profile-menu">

                            <div class="dropdown-header text-center">
                                <div class="profile-avatar-large mx-auto mb-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <span class="ml-2">Dashboard</span>
                            </a>

                            <a class="dropdown-item" href="{{ route('offer.ride') }}">
                                <span class="ml-2">Offer Ride</span>
                            </a>

                            <a class="dropdown-item" href="{{ route('rides.index') }}">
                                <span class="ml-2">View Rides</span>
                            </a>

                            <a class="dropdown-item" href="{{ route('rides.my') }}">
                                <span class="ml-2">My Rides</span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center"
                                href="{{ route('booking.my') }}">
                                <span class="ml-2">My Bookings</span>
                                @if(isset($unreadBookingsCount) && $unreadBookingsCount > 0)
                                    <span class="badge badge-pill badge-danger"
                                        style="background-color: #ff3b30; color: white; font-weight: bold; font-size: 10px; padding: 3px 6px;">{{ $unreadBookingsCount }}</span>
                                @endif
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center"
                                href="{{ route('rides.requests') }}">
                                <span class="ml-2">Ride Requests</span>
                                @if(isset($unreadRequestsCount) && $unreadRequestsCount > 0)
                                    <span class="badge badge-pill badge-danger"
                                        style="background-color: #ff3b30; color: white; font-weight: bold; font-size: 10px; padding: 3px 6px;">{{ $unreadRequestsCount }}</span>
                                @endif
                            </a>

                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <span class="ml-2">Edit Profile</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <span class="ml-2">Logout</span>
                                </button>
                            </form>

                        </div>
                    </li>

                @else

                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Login
                        </a>
                    </li>

                @endif

            </ul>
        </div>
    </div>
</nav>
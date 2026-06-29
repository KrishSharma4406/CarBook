  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{url('/')}}">Car<span>Book</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
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

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center"
       href="#"
       id="profileDropdown"
       role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">

        <div class="profile-avatar mr-2">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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

		<a class="dropdown-item" href="{{ route('rides.requests') }}">
    		<span class="ml-2">Ride Requests</span>
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
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
			  <li>
			@if (Auth::check())
			  <form method="POST" action="{{ route('logout') }}">
    			@csrf
    			<a href="{{ route('logout') }}" class="text-white nav-link"
       			onclick="event.preventDefault(); this.closest('form').submit();">
        			Logout
    			</a>
			</form>
			@else
				<a href="{{ route('login') }}" class="text-white nav-link">Login</a>
				@endif
		</li>

		@if (Auth::check())
			  <form method="POST" action="{{ route('profile') }}">
    			@csrf
    			<a href="{{ route('profile') }}" class="text-white nav-link">
        			Profile
    			</a>
			</form>
			@else
				<div></div>
				@endif
		</li>

	        </ul>
	      </div>
	    </div>
	  </nav>


<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>

    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start" style="height:320px;">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2">
                        <a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a>
                    </span>
                    <span>My Rides <i class="ion-ios-arrow-forward"></i></span>
                </p>

                <h1 class="mb-0 bread text-white">
                    My Offered Rides
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="ftco-section bg-light">

    <div class="container">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row">

            @forelse($rides as $ride)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="mb-0">

                                {{ $ride->pickup_location }}

                                <i class="fa fa-arrow-right mx-2 text-success"></i>

                                {{ $ride->destination }}

                            </h5>

                            @if($ride->status == 'cancelled')
                                <span class="badge badge-danger">
                                    Cancelled
                                </span>
                            @elseif(\Carbon\Carbon::parse($ride->travel_date)->lt(\Carbon\Carbon::today()))
                                @if($ride->bookings()->where('status', 'accepted')->exists())
                                    <span class="badge badge-info">
                                        Completed
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        Ride Not Booked
                                    </span>
                                @endif
                            @else
                                <span class="badge badge-success">
                                    {{ ucfirst($ride->status) }}
                                </span>
                            @endif

                        </div>

                        <hr>

                        <p>
                            <i class="fa fa-calendar text-success mr-2"></i>

                            <strong>Date:</strong>

                            {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                        </p>

                        <p>
                            <i class="fa fa-clock text-success mr-2"></i>

                            <strong>Time:</strong>

                            {{ \Carbon\Carbon::parse($ride->travel_time)->format('h:i A') }}

                        </p>

                        <p>
                            <i class="fa fa-users text-success mr-2"></i>

                            <strong>Seats:</strong>

                            {{ $ride->available_seats }}

                        </p>

                        <p>
                            <i class="fa fa-money text-success mr-2"></i>

                            <strong>Fare:</strong>

                            ₹{{ $ride->fare }}

                        </p>

                        <div class="mt-4">

                            <a href="{{ route('rides.edit',$ride->id) }}"
                                class="btn btn-success btn-sm">

                                <i class="fa fa-edit"></i>

                                Edit

                            </a>

                            <form
                                action="{{ route('rides.destroy',$ride->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this ride?')">

                                    <i class="fa fa-trash"></i>

                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-md-12">

                <div class="card shadow border-0">

                    <div class="card-body text-center py-5">

                        <i class="fa fa-car fa-4x text-success mb-4"></i>

                        <h3>No Rides Offered Yet</h3>

                        <p class="text-muted">
                            Start offering rides and help others travel while earning money.
                        </p>

                        <a href="{{ route('offer.ride') }}"
                            class="btn btn-success mt-3">

                            <i class="fa fa-plus"></i>

                            Offer Your First Ride

                        </a>

                    </div>

                </div>

            </div>

            @endforelse

        </div>

    </div>

</section>

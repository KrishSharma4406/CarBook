

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

        {{-- ──────────── UPCOMING / ACTIVE RIDES ──────────── --}}
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">
                <i class="fa fa-check-circle text-success mr-2"></i>
                Upcoming Rides
            </h3>
            <span class="badge badge-success ml-2" style="font-size: 14px;">{{ $upcomingRides->count() }}</span>
        </div>

        <div class="row">

            @forelse($upcomingRides as $ride)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #28a745 !important;">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="mb-0">

                                {{ $ride->pickup_location }}

                                <i class="fa fa-arrow-right mx-2 text-success"></i>

                                {{ $ride->destination }}

                            </h5>

                            <span class="badge badge-success">
                                <i class="fa fa-check-circle mr-1"></i> Active
                            </span>

                        </div>

                        <hr>

                        <p>
                            <i class="fa fa-calendar text-success mr-2"></i>

                            <strong>Date:</strong>

                            {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}
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

                        <h3>No Upcoming Rides</h3>

                        <p class="text-muted">
                            You don't have any upcoming rides. Offer a ride to get started!
                        </p>

                        <a href="{{ route('offer.ride') }}"
                            class="btn btn-success mt-3">

                            <i class="fa fa-plus"></i>

                            Offer a Ride

                        </a>

                    </div>

                </div>

            </div>

            @endforelse

        </div>

        {{-- ──────────── EXPIRED / PAST RIDES ──────────── --}}
        @if($expiredRides->count() > 0)
        <hr class="my-5">

        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">
                <i class="fa fa-history text-secondary mr-2"></i>
                Past / Expired Rides
            </h3>
            <span class="badge badge-secondary ml-2" style="font-size: 14px;">{{ $expiredRides->count() }}</span>
        </div>

        <div class="row">

            @foreach($expiredRides as $ride)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #6c757d !important; opacity: 0.85;">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="mb-0">

                                {{ $ride->pickup_location }}

                                <i class="fa fa-arrow-right mx-2 text-secondary"></i>

                                {{ $ride->destination }}

                            </h5>

                            @if($ride->status == 'cancelled')
                                <span class="badge badge-danger">
                                    <i class="fa fa-times-circle mr-1"></i> Cancelled
                                </span>
                            @elseif($ride->status == 'completed')
                                <span class="badge badge-info">
                                    <i class="fa fa-check mr-1"></i> Completed
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fa fa-clock-o mr-1"></i> Expired
                                </span>
                            @endif

                        </div>

                        <hr>

                        <p>
                            <i class="fa fa-calendar text-secondary mr-2"></i>

                            <strong>Date:</strong>

                            {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                            <small class="text-danger ml-1">(Passed)</small>
                        </p>

                        <p>
                            <i class="fa fa-users text-secondary mr-2"></i>

                            <strong>Seats:</strong>

                            {{ $ride->available_seats }}

                        </p>

                        <p>
                            <i class="fa fa-money text-secondary mr-2"></i>

                            <strong>Fare:</strong>

                            ₹{{ $ride->fare }}

                        </p>

                        <div class="mt-4">
                            <form
                                action="{{ route('rides.destroy',$ride->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Delete this ride?')">

                                    <i class="fa fa-trash"></i>

                                    Delete

                                </button>

                            </form>
                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>
        @endif

    </div>

</section>

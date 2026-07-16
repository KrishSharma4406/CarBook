<style>
    .route-line {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .route-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid #1a1a2e;
        flex-shrink: 0;
    }
    .route-dash {
        flex: 1;
        height: 2px;
        background: repeating-linear-gradient(
            to right,
            #c0c0c0 0px,
            #c0c0c0 6px,
            transparent 6px,
            transparent 10px
        );
        position: relative;
    }
    .route-city {
        font-weight: 700;
        font-size: 16px;
        color: #1a1a2e;
    }
</style>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>

    <div class="container">

        <div class="row no-gutters slider-text js-fullheight align-items-end">

            <div class="col-md-9 pb-5">

                <h1 class="mb-3 bread">

                    Find a Ride

                </h1>

            </div>

        </div>

    </div>

</section>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<section class="ftco-section">

    <div class="container">

        <form action="{{ route('rides.index') }}" method="GET">

            <div class="row mb-5">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="pickup_location"
                        class="form-control"
                        placeholder="Pickup"
                        value="{{ request('pickup_location') }}">

                </div>

                <div class="col-md-4">

                    <input
                        type="text"
                        name="destination"
                        class="form-control"
                        placeholder="Destination"
                        value="{{ request('destination') }}">

                </div>

                <div class="col-md-3">

                    <input
                        type="date"
                        name="travel_date"
                        class="form-control"
                        min="{{ date('Y-m-d') }}"
                        value="{{ request('travel_date') }}">

                </div>

                <div class="col-md-1">

                    <button class="btn btn-success btn-block">

                        Search

                    </button>

                </div>

            </div>

        </form>

        <div class="row">

            @forelse($rides as $ride)

            <div class="col-md-6">

                <div class="card shadow mb-4">

                    <div class="card-body">

                        <div class="route-line mb-3">
                            <span class="route-city">{{ $ride->pickup_location }}</span>
                            <span class="route-dot"></span>
                            <span class="route-dash"></span>
                            <span class="route-dot"></span>
                            <span class="route-city">{{ $ride->destination }}</span>
                        </div>

                        <hr>

                        <p>

                            <strong>Driver:</strong>

                            {{ $ride->user->name }}

                        </p>

                        <p>

                            <strong>Date:</strong>

                            {{ $ride->travel_date }}

                        </p>

                        @if($ride->duration)
                        <p>
                            <strong>Duration:</strong>
                            <span class="badge badge-warning text-dark px-2 py-1" style="font-size: 12px; font-weight: 600;">
                                <i class="fa fa-clock-o mr-1"></i>
                                {{ $ride->duration }}
                            </span>
                        </p>
                        @endif

                        <p>

                            <strong>Vehicle:</strong>

                            {{ $ride->vehicle_name }}

                        </p>

                        <p>

                            <strong>Vehicle No:</strong>

                            {{ $ride->vehicle_number }}

                        </p>

                        <p>

                            <strong>Seats:</strong>

                            {{ $ride->available_seats }}

                        </p>

                        <p>

                            <strong>Fare:</strong>

                            ₹{{ $ride->fare }}

                        </p>

                        @if($ride->description)

                        <p>

                            <strong>Note:</strong>

                            {{ $ride->description }}

                        </p>

                        @endif

                        @if(\Carbon\Carbon::parse($ride->travel_date)->lt(\Carbon\Carbon::today()))
                            <button class="btn btn-secondary btn-block" disabled>
                                <i class="fa fa-ban mr-1"></i> Ride Expired
                            </button>
                        @else
                            <a href="{{ route('booking.summary', $ride->id) }}"
                                class="btn btn-success btn-block">

                                Book This Ride

                            </a>
                        @endif

                    </div>

                </div>

            </div>

            @empty

            <div class="col-md-12">

                <div class="alert alert-warning">

                    No rides found.

                </div>

            </div>

            @endforelse

        </div>

    </div>

</section>
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
                        name="pickup"
                        class="form-control"
                        placeholder="Pickup"
                        value="{{ request('pickup') }}">

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

                        <h4>

                            {{ $ride->pickup_location }}

                            <i class="fa fa-arrow-right"></i>

                            {{ $ride->destination }}

                        </h4>

                        <hr>

                        <p>

                            <strong>Driver:</strong>

                            {{ $ride->user->name }}

                        </p>

                        <p>

                            <strong>Date:</strong>

                            {{ $ride->travel_date }}

                        </p>

                        <p>

                            <strong>Time:</strong>

                            {{ $ride->travel_time }}

                        </p>

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

                        <a href="{{ route('booking.summary', $ride->id) }}"
                            class="btn btn-success btn-block">

                            Book This Ride

                        </a>

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
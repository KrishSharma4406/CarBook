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

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI') }}/images/bg_3.jpg');"
    data-stellar-background-ratio="0.5">

    <div class="overlay"></div>

    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Available Rides</span>
                </p>

                <h1 class="mb-3 bread">Available Rides</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">

    <div class="container mb-5 w-auto">

        <div class="card shadow border-0 rounded-lg">
            <div class="card-body py-4">

                <form id="searchForm">

                    <div class="row align-items-end">

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="font-weight-bold">
                                <i class="fa fa-map-marker text-success"></i>
                                Pickup Location
                            </label>

                            <input
                                type="text"
                                name="pickup_location"
                                id="pickup_location"
                                class="form-control"
                                placeholder="Enter Pickup Location"
                                value="{{ request('pickup_location') }}">
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="font-weight-bold">
                                <i class="fa fa-location-arrow text-danger"></i>
                                Destination
                            </label>

                            <input
                                type="text"
                                name="destination"
                                id="destination"
                                class="form-control"
                                placeholder="Enter Destination"
                                value="{{ request('destination') }}">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="font-weight-bold">
                                <i class="fa fa-calendar text-primary"></i>
                                Travel Date
                            </label>

                            <input
                                type="date"
                                name="travel_date"
                                id="travel_date"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                value="{{ request('travel_date') }}">
                        </div>

                        <div class="col-lg-1 col-md-6 mb-3">
                            <button type="submit"
                                class="btn btn-success btn-block w-9 py-10">Search
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

    <div class="container">
        <div id="rideList">

            @if($rides->count())

                @foreach($rides as $ride)

                    <div class="card shadow-lg border-0 rounded mb-4">

                        <div class="card-body p-4">

                            <div class="row align-items-center">

                                <div class="col-md-2 text-center">

                                    @php
                                    $filename = $ride->user->profile_image ?? 'default.png';
                                    @endphp

                                    <img src="{{ asset('uploads/profileimages/' . $filename) }}"
                                        alt="{{ $ride->user->name ?? 'User' }}"
                                        class="rounded-circle shadow mb-2"
                                        width="80"
                                        height="80"
                                        style="object-fit:cover;border:2px solid #ddd;">

                                    <h6 class="mt-2 mb-0">
                                        {{ $ride->user->name }}
                                    </h6>

                                </div>

                                <div class="col-md-5">

                                    <div class="route-line mb-3">
                                        <span class="route-city">{{ $ride->pickup_location }}</span>
                                        <span class="route-dot"></span>
                                        <span class="route-dash"></span>
                                        <span class="route-dot"></span>
                                        <span class="route-city">{{ $ride->destination }}</span>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="mr-3">
                                            <i class="fa fa-calendar text-primary mr-1"></i>
                                            {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}
                                        </span>
                                        @if($ride->duration)
                                            <span class="badge badge-warning text-dark px-2 py-1" style="font-size: 12px; font-weight: 600;">
                                                <i class="fa fa-clock-o mr-1"></i>
                                                {{ $ride->duration }}
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-2 text-center">

                                    <h4 class="text-success">

                                        ₹{{ $ride->fare }}

                                    </h4>

                                    <small>per seat</small>

                                </div>

                                <div class="col-md-1 text-center">

                                    <span class="badge badge-primary p-2">

                                        {{ $ride->available_seats }}

                                        Seats

                                    </span>

                                </div>

                                <div class="col-md-2 text-center">

                                    @if(\Carbon\Carbon::parse($ride->travel_date)->lt(\Carbon\Carbon::today()))
                                        <button class="btn btn-secondary btn-block" disabled>
                                            <i class="fa fa-ban mr-1"></i> Ride Expired
                                        </button>
                                    @else
                                        <a href="{{ route('rides.show', $ride->id) }}" class="btn btn-primary btn-block">
                                            View Ride
                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="text-center py-5">

                    <h3 class="mt-4">

                        No Rides Found

                    </h3>

                    <p class="text-muted">

                        Try changing the pickup, destination or date.

                    </p>

                    <a href="{{ route('home') }}" class="btn btn-primary">

                        Search Again

                    </a>

                </div>

            @endif
        </div>
    </div>

</section>

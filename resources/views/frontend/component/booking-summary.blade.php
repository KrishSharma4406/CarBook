

<!-- Hero -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>

    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start" style="height:320px;">
            <div class="col-md-9 pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ url('/') }}">
                            Home
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>

                    <span>
                        Booking Summary
                    </span>
                </p>

                <h1 class="bread">
                    Booking Summary
                </h1>

            </div>
        </div>
    </div>

</section>

<section class="ftco-section bg-light">

    <div class="container">

        @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

        @endif

        <div class="row">

            <!-- Ride Details -->

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-success text-white">

                        <h4>

                            Ride Information

                        </h4>

                    </div>

                    <div class="card-body">

                        <h3>

                            {{ $ride->pickup_location }}

                            <i class="fa fa-arrow-right mx-2 text-success"></i>

                            {{ $ride->destination }}

                        </h3>

                        <hr>

                        <div class="row">

                            <div class="col-md-6">

                                <p>

                                    <strong>Driver</strong>

                                    <br>

                                    {{ $ride->user->name }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Travel Date</strong>

                                    <br>

                                    {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Departure Time</strong>

                                    <br>

                                    {{ \Carbon\Carbon::parse($ride->travel_time)->format('h:i A') }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Available Seats</strong>

                                    <br>

                                    {{ $ride->available_seats }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Vehicle</strong>

                                    <br>

                                    {{ $ride->vehicle_name }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Vehicle Number</strong>

                                    <br>

                                    {{ $ride->vehicle_number }}

                                </p>

                            </div>

                            <div class="col-md-12">

                                <p>

                                    <strong>Description</strong>

                                    <br>

                                    {{ $ride->description ?? 'No description provided.' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Booking Card -->

            <div class="col-lg-4">

                <div class="card shadow border-0">

                    <div class="card-header bg-dark text-white">

                        Booking Details

                    </div>

                    <div class="card-body">

                        <form action="{{ route('booking.confirm',$ride->id) }}" method="POST">

                            @csrf

                            <div class="form-group">

                                <label>

                                    Number of Seats

                                </label>

                                <input
                                    type="number"
                                    name="seats"
                                    class="form-control"
                                    value="1"
                                    min="1"
                                    max="{{ $ride->available_seats }}"
                                    required>

                            </div>

                            <hr>

                            <h5>

                                Fare Per Seat

                                <span class="float-right">

                                    ₹{{ $ride->fare }}

                                </span>

                            </h5>

                            <hr>

                            <button
                                type="submit"
                                class="btn btn-success btn-block btn-lg">

                                Request Booking

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

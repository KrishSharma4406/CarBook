@extends('frontend.layout.app')

@section('content')

<section class="hero-wrap hero-wrap-2"
    style="background-image:url('{{ asset('UI/images/bg_3.jpg') }}')">

    <div class="overlay"></div>

    <div class="container">

        <div class="row slider-text align-items-end">

            <div class="col-md-9 pb-5">

                <h1 class="bread">

                    Ride Details

                </h1>

            </div>

        </div>

    </div>

</section>

<section class="ftco-section bg-light">

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-success text-white">

                        <h4>

                            {{ $ride->pickup_location }}

                            <i class="fa fa-arrow-right mx-2"></i>

                            {{ $ride->destination }}

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

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

                                    <strong>Seats Available</strong>

                                    <br>

                                    {{ $ride->available_seats }}

                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>

                                    <strong>Fare</strong>

                                    <br>

                                    ₹{{ $ride->fare }}

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

                        </div>

                        <hr>

                        <h5>Description</h5>

                        <p>

                            {{ $ride->description ?: 'No additional information provided.' }}

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card shadow border-0">

                    <div class="card-body text-center">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($ride->user->name) }}&background=01d28e&color=fff&size=128"
                            class="rounded-circle mb-3">

                        <h4>

                            {{ $ride->user->name }}

                        </h4>

                        <p>

                            Ride Owner

                        </p>

                        <hr>

                        <a href="{{ route('booking.summary', $ride->id) }}"
                            class="btn btn-success btn-block btn-lg">
                            Book This Ride
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
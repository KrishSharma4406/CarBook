@extends('frontend.layout.app')

@section('content')

<style>
.table th{
    width:35%;
    background:#f8f9fa;
}

.table td,
.table th{
    vertical-align:middle;
}

.card{
    border-radius:12px;
}

.card-header{
    border-radius:12px 12px 0 0!important;
}

img{
    border-radius:10px;
}
</style>

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

                        <!-- Ride Information -->

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <strong>Travel Date</strong><br>

                                {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Departure Time</strong><br>

                                {{ \Carbon\Carbon::parse($ride->travel_time)->format('h:i A') }}

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Seats Available</strong><br>

                                {{ $ride->available_seats }}

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Fare</strong><br>

                                <span class="text-success font-weight-bold">

                                    ₹{{ number_format($ride->fare) }}

                                </span>

                            </div>

                        </div>

                        <hr>

                        <!-- Car Information -->

                        <h4 class="mb-4">

                            Car Information

                        </h4>

                        <div class="row">

                            <div class="col-md-5">

                                <img src="{{ asset('uploads/cars/'.$ride->car->image) }}"
                                    class="img-fluid rounded shadow"
                                    style="width:100%;height:300px;object-fit:cover;">

                            </div>

                            <div class="col-md-7">

                                <table class="table table-striped table-bordered">

                                    <tr>

                                        <th width="35%">Car Name</th>

                                        <td>{{ $ride->car->car_name }}</td>

                                    </tr>

                                    <tr>

                                        <th>Brand</th>

                                        <td>{{ $ride->car->brand }}</td>

                                    </tr>

                                    <tr>

                                        <th>Model</th>

                                        <td>{{ $ride->car->model }}</td>

                                    </tr>

                                    <tr>

                                        <th>Registration</th>

                                        <td>{{ $ride->car->registration_number }}</td>

                                    </tr>

                                    <tr>

                                        <th>Fuel</th>

                                        <td>{{ $ride->car->fuel_type }}</td>

                                    </tr>

                                    <tr>

                                        <th>Transmission</th>

                                        <td>{{ $ride->car->transmission }}</td>

                                    </tr>

                                    <tr>

                                        <th>Color</th>

                                        <td>{{ ucfirst($ride->car->color) }}</td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                        <hr>

                        <h5>Description</h5>

                        <p class="text-muted">

                            {{ $ride->description ?: 'No additional information provided.' }}

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card shadow border-0 sticky-top" style="top:100px;">

                    <div class="card-body text-center">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($ride->user->name) }}&background=01d28e&color=fff&size=150"
                            class="rounded-circle mb-3 shadow">

                        <h4>

                            {{ $ride->user->name }}

                        </h4>

                        <p class="text-muted">

                            Ride Owner

                        </p>

                        <hr>

                        <h3 class="text-success">

                            ₹{{ number_format($ride->fare) }}

                        </h3>

                        <p>

                            <i class="fa fa-users text-success"></i>

                            {{ $ride->available_seats }} Seats Available

                        </p>

                        <a href="{{ route('booking.summary',$ride->id) }}"
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
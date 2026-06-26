@extends('frontend.layout.app')
@section('content')

<section class="hero-wrap hero-wrap-2"
    style="background-image:url('{{ asset('UI/images/bg_3.jpg') }}');">

    <div class="overlay"></div>

    <div class="container">

        <div class="row no-gutters slider-text align-items-end justify-content-center">

            <div class="col-md-9 text-center mb-5">

                <h1 class="mb-2 bread text-white">
                    {{ $car->car_name }}
                </h1>

                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ url('/') }}">
                            Home
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>

                    <span>
                        Car Details
                    </span>
                </p>

            </div>

        </div>

    </div>

</section>


<section class="ftco-section">

<div class="container">

<div class="row">

    <!-- Image -->

    <div class="col-lg-5">

        <img src="{{ asset('uploads/cars/'.$car->image) }}"
             class="img-fluid rounded shadow-lg w-100"
             style="height:400px;object-fit:cover;">

    </div>

    <!-- Details -->

    <div class="col-lg-7">

        <div class="card border-0 shadow-lg">

            <div class="card-body p-auto">

                <h2 class="mb-4">

                    {{ $car->car_name }}

                </h2>

                <table class="table table-borderless">

                    <tr>

                        <th width="35%">Owner</th>

                        <td>{{ $car->user->name }}</td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td>{{ $car->user->email }}</td>

                    </tr>

                    <tr>

                        <th>Phone</th>

                        <td>{{ $car->user->phone }}</td>

                    </tr>

                    <tr>

                        <th>Brand</th>

                        <td>{{ $car->brand }}</td>

                    </tr>

                    <tr>

                        <th>Model</th>

                        <td>{{ $car->model }}</td>

                    </tr>

                    <tr>

                        <th>Registration</th>

                        <td>{{ $car->registration_number }}</td>

                    </tr>

                    <tr>

                        <th>Fuel Type</th>

                        <td>{{ $car->fuel_type }}</td>

                    </tr>

                    <tr>

                        <th>Transmission</th>

                        <td>{{ $car->transmission }}</td>

                    </tr>

                    <tr>

                        <th>Color</th>

                        <td>{{ $car->color }}</td>

                    </tr>

                    <tr>

                        <th>Rent</th>

                        <td>

                            <span class="badge badge-success p-2">

                                ₹{{ number_format($car->rent_per_day) }}/Day

                            </span>

                        </td>

                    </tr>

                </table>

                <hr>

                <h5>Description</h5>

                <p>

                    {{ $car->description }}

                </p>

                <a href="{{ url()->previous() }}"
                   class="btn btn-primary">

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

</div>

</section>

@endsection
@extends('admin.frontend.webview.home')

@section('content')

@can('cars.view')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Car Details</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-5">

                    <div class="card">

                        <div class="card-body text-center">

                            <img src="{{ asset('uploads/cars/'.$car->image) }}"
                                class="img-fluid rounded shadow">

                        </div>

                    </div>

                </div>

                <div class="col-md-7">

                    <div class="card">

                        <div class="card-header">

                            <h3>

                                {{ $car->brand }}

                                {{ $car->model }}

                            </h3>

                        </div>

                        <div class="card-body">

                            <table class="table">

                                <tr>

                                    <th>Owner</th>

                                    <td>{{ $car->user->name }}</td>

                                </tr>

                                <tr>

                                    <th>Email</th>

                                    <td>{{ $car->user->email }}</td>

                                </tr>

                                <tr>

                                    <th>Car Name</th>

                                    <td>{{ $car->car_name }}</td>

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

                                    <th>Fuel</th>

                                    <td>{{ $car->fuel_type }}</td>

                                </tr>

                                <tr>

                                    <th>Transmission</th>

                                    <td>{{ $car->transmission }}</td>

                                </tr>

                                <tr>

                                    <th>Year</th>

                                    <td>{{ $car->manufacturing_year }}</td>

                                </tr>

                                <tr>

                                    <th>Color</th>

                                    <td>{{ $car->color }}</td>

                                </tr>

                                <tr>

                                    <th>Rent</th>

                                    <td>

                                        ₹{{ number_format($car->rent_per_day) }}/day

                                    </td>

                                </tr>

                                <tr>

                                    <th>Description</th>

                                    <td>{{ $car->description }}</td>

                                </tr>

                            </table>

                            <a href="{{ route('admin.cars.index') }}"
                                class="btn btn-primary">

                                Back

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endcan

@cannot('cars.view')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid mt-3">
            <div class="alert alert-danger">
                You do not have permission to view car details.
            </div>
        </div>
    </section>
</div>
@endcannot

@endsection
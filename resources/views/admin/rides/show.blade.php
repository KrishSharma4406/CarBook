@extends('admin.frontend.webview.home')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Ride Details</h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.rides.index') }}" class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- Driver Details -->

                <div class="col-md-4">

                    <div class="card card-primary">

                        <div class="card-header">

                            <h3 class="card-title">

                                Driver Information

                            </h3>

                        </div>

                        <div class="card-body text-center">

                            @if($ride->car && $ride->car->image)

                            <img src="{{ asset('uploads/cars/'.$ride->car->image) }}"
                                class="img-fluid rounded shadow mb-3"
                                style="height:220px;width:100%;object-fit:cover;">

                            @endif

                            <h4>

                                {{ $ride->user->name }}

                            </h4>

                            <hr>

                            <table class="table table-bordered">

                                <tr>

                                    <th>Email</th>

                                    <td>

                                        {{ $ride->user->email }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>Phone</th>

                                    <td>

                                        {{ $ride->user->phone ?? 'N/A' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>Status</th>

                                    <td>

                                        @if($ride->user->status)

                                        <span class="badge badge-success">

                                            Active

                                        </span>

                                        @else

                                        <span class="badge badge-danger">

                                            Blocked

                                        </span>

                                        @endif

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- Ride Information -->

                <div class="col-md-8">

                    <div class="card card-success">

                        <div class="card-header">

                            <h3 class="card-title">

                                Ride Information

                            </h3>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th>Pickup</th>

                                            <td>

                                                {{ $ride->pickup_location }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Destination</th>

                                            <td>

                                                {{ $ride->destination }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Date</th>

                                            <td>

                                                {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Time</th>

                                            <td>

                                                {{ \Carbon\Carbon::parse($ride->travel_time)->format('h:i A') }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                                <div class="col-md-6">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th>Fare</th>

                                            <td>

                                                ₹{{ number_format($ride->fare) }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Seats Left</th>

                                            <td>

                                                {{ $ride->available_seats }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Status</th>

                                            <td>

                                                @if($ride->status=='active')

                                                <span class="badge badge-success">

                                                    Active

                                                </span>

                                                @elseif($ride->status=='completed')

                                                <span class="badge badge-primary">

                                                    Completed

                                                </span>

                                                @else

                                                <span class="badge badge-danger">

                                                    Cancelled

                                                </span>

                                                @endif

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Total Requests</th>

                                            <td>

                                                {{ $ride->bookings->count() }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <hr>

                            <h4 class="mb-3">

                                <i class="fas fa-car text-success"></i>

                                Car Information

                            </h4>

                            <div class="row">

                                <div class="col-md-12">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th width="250">

                                                Car Name

                                            </th>

                                            <td>

                                                {{ $ride->car->car_name ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Brand

                                            </th>

                                            <td>

                                                {{ $ride->car->brand ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Model

                                            </th>

                                            <td>

                                                {{ $ride->car->model ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Registration Number

                                            </th>

                                            <td>

                                                {{ $ride->car->registration_number ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Manufacturing Year

                                            </th>

                                            <td>

                                                {{ $ride->car->manufacturing_year ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Fuel Type

                                            </th>

                                            <td>

                                                {{ $ride->car->fuel_type ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Transmission

                                            </th>

                                            <td>

                                                {{ $ride->car->transmission ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Color

                                            </th>

                                            <td>

                                                {{ $ride->car->color ?? 'N/A' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Rent Per Day

                                            </th>

                                            <td>

                                                ₹{{ number_format($ride->car->rent_per_day ?? 0) }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Description

                                            </th>

                                            <td>

                                                {{ $ride->car->description ?? 'No description available.' }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row mt-4">

                    <div class="col-md-12">

                        <div class="card card-info">

                            <div class="card-header">

                                <h3 class="card-title">

                                    Passenger Booking Requests

                                </h3>

                            </div>

                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Passenger</th>

                                            <th>Email</th>

                                            <th>Seats</th>

                                            <th>Status</th>

                                            <th>Booked On</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($ride->bookings as $booking)

                                        <tr>

                                            <td>

                                                {{ $booking->id }}

                                            </td>

                                            <td>

                                                <strong>

                                                    {{ $booking->user->name }}

                                                </strong>

                                            </td>

                                            <td>

                                                {{ $booking->user->email }}

                                            </td>

                                            <td>

                                                {{ $booking->seats }}

                                            </td>

                                            <td>

                                                @if($booking->booking_status=='pending')

                                                <span class="badge badge-warning">

                                                    Pending

                                                </span>

                                                @elseif($booking->booking_status=='accepted')

                                                <span class="badge badge-success">

                                                    Accepted

                                                </span>

                                                @elseif($booking->booking_status=='rejected')

                                                <span class="badge badge-danger">

                                                    Rejected

                                                </span>

                                                @else

                                                <span class="badge badge-secondary">

                                                    {{ ucfirst($booking->booking_status) }}

                                                </span>

                                                @endif

                                            </td>

                                            <td>

                                                {{ $booking->created_at->format('d M Y h:i A') }}

                                            </td>

                                        </tr>

                                        @empty

                                        <tr>

                                            <td colspan="6" class="text-center text-muted py-4">

                                                <i class="fas fa-info-circle fa-2x mb-2"></i>

                                                <br>

                                                No booking requests for this ride.

                                            </td>

                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

    </section>

</div>

@endsection
@extends('admin.frontend.webview.home')

@section('content')

@can('bookings.view')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Booking Details</h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.bookings.index') }}"
                        class="btn btn-secondary">

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

                <!-- Passenger -->

                <div class="col-md-4">

                    <div class="card card-primary">

                        <div class="card-header">

                            <h3 class="card-title">

                                Passenger Information

                            </h3>

                        </div>

                        <div class="card-body">

                            <table class="table table-bordered">

                                <tr>

                                    <th>Name</th>

                                    <td>{{ $booking->user->name }}</td>

                                </tr>

                                <tr>

                                    <th>Email</th>

                                    <td>{{ $booking->user->email }}</td>

                                </tr>

                                <tr>

                                    <th>Phone</th>

                                    <td>{{ $booking->user->phone ?? 'N/A' }}</td>

                                </tr>

                                <tr>

                                    <th>Status</th>

                                    <td>

                                        @if($booking->user->status)

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

                <!-- Driver -->

                <div class="col-md-4">

                    <div class="card card-success">

                        <div class="card-header">

                            <h3 class="card-title">

                                Driver Information

                            </h3>

                        </div>

                        <div class="card-body">

                            <table class="table table-bordered">

                                <tr>

                                    <th>Name</th>

                                    <td>{{ $booking->ride->user->name }}</td>

                                </tr>

                                <tr>

                                    <th>Email</th>

                                    <td>{{ $booking->ride->user->email }}</td>

                                </tr>

                                <tr>

                                    <th>Phone</th>

                                    <td>{{ $booking->ride->user->phone ?? 'N/A' }}</td>

                                </tr>

                                <tr>

                                    <th>Status</th>

                                    <td>

                                        @if($booking->ride->user->status)

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

                <!-- Car -->

                <div class="col-md-4">

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">

                                Car Information

                            </h3>

                        </div>

                        <div class="card-body text-center">

                            @if($booking->ride->car && $booking->ride->car->image)

                            <img src="{{ asset('uploads/cars/'.$booking->ride->car->image) }}"
                                class="img-fluid rounded shadow mb-3"
                                style="height:220px;width:100%;object-fit:cover;">

                            @else

                            <img src="{{ asset('UI/images/car-1.jpg') }}"
                                class="img-fluid rounded shadow mb-3">

                            @endif

                            <h4>

                                {{ $booking->ride->car->brand }}

                                {{ $booking->ride->car->model }}

                            </h4>

                            <p>

                                {{ $booking->ride->car->registration_number }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header bg-dark">

                            <h3 class="card-title">

                                Ride Details

                            </h3>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th>Pickup</th>

                                            <td>{{ $booking->ride->pickup_location }}</td>

                                        </tr>

                                        <tr>

                                            <th>Destination</th>

                                            <td>{{ $booking->ride->destination }}</td>

                                        </tr>

                                        <tr>

                                            <th>Date</th>

                                            <td>

                                                {{ \Carbon\Carbon::parse($booking->ride->travel_date)->format('d M Y') }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Time</th>

                                            <td>

                                                {{ \Carbon\Carbon::parse($booking->ride->travel_time)->format('h:i A') }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                                <div class="col-md-6">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th>Fare</th>

                                            <td>

                                                ₹{{ number_format($booking->ride->fare) }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Seats Left</th>

                                            <td>

                                                {{ $booking->ride->available_seats }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Ride Status</th>

                                            <td>

                                                {{ ucfirst($booking->ride->status) }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>Total Requests</th>

                                            <td>

                                                {{ $booking->ride->bookings->count() }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-12">

                    <div class="card card-warning">

                        <div class="card-header">

                            <h3 class="card-title">

                                Booking Information

                            </h3>

                        </div>

                        <div class="card-body">

                            <table class="table table-bordered">

                                <tr>

                                    <th width="250">

                                        Booking ID

                                    </th>

                                    <td>

                                        #{{ $booking->id }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Seats Booked

                                    </th>

                                    <td>

                                        {{ $booking->seats }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Booking Status

                                    </th>

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

                                            Cancelled

                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Booked On

                                    </th>

                                    <td>

                                        {{ $booking->created_at->format('d M Y h:i A') }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Last Updated

                                    </th>

                                    <td>

                                        {{ $booking->updated_at->format('d M Y h:i A') }}

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endcan

@endsection
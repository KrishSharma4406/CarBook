@extends('admin.frontend.webview.home')

@section('content')

@can('bookings.view')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Booking Management</h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        All Ride Bookings

                    </h3>

                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover table-bordered">

                        <thead class="thead-dark">

                        <tr>

                            <th>ID</th>

                            <th>Car</th>

                            <th>Passenger</th>

                            <th>Driver</th>

                            <th>Route</th>

                            <th>Seats</th>

                            <th>Fare</th>

                            <th>Status</th>

                            <th>Booked On</th>

                            <th>Action</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($bookings as $booking)

                        <tr>

                            <td>

                                {{ $booking->id }}

                            </td>

                            <td width="120">

                                @if($booking->ride->car && $booking->ride->car->image)

                                    <img src="{{ asset('uploads/cars/'.$booking->ride->car->image) }}"
                                         style="width:110px;height:70px;object-fit:cover;border-radius:8px;">

                                @else

                                    <img src="{{ asset('UI/images/car-1.jpg') }}"
                                         style="width:110px;height:70px;object-fit:cover;border-radius:8px;">

                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $booking->user->name }}

                                </strong>

                                <br>

                                <small>

                                    {{ $booking->user->email }}

                                </small>

                            </td>

                            <td>

                                <strong>

                                    {{ $booking->ride->user->name }}

                                </strong>

                                <br>

                                <small>

                                    {{ $booking->ride->user->email }}

                                </small>

                            </td>

                            <td>

                                <strong>

                                    {{ $booking->ride->pickup_location }}

                                </strong>

                                <br>

                                <i class="fas fa-arrow-down text-success"></i>

                                <br>

                                <strong>

                                    {{ $booking->ride->destination }}

                                </strong>

                            </td>

                            <td>

                                {{ $booking->seats }}

                            </td>

                            <td>

                                ₹{{ number_format($booking->ride->fare) }}

                            </td>

                            <td>

                                @if($booking->booking_status=="pending")

                                    <span class="badge badge-warning">

                                        Pending

                                    </span>

                                @elseif($booking->booking_status=="accepted")

                                    <span class="badge badge-success">

                                        Accepted

                                    </span>

                                @elseif($booking->booking_status=="rejected")

                                    <span class="badge badge-danger">

                                        Rejected

                                    </span>

                                @elseif($booking->booking_status=="cancelled")

                                    <span class="badge badge-secondary">

                                        Cancelled

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $booking->created_at->format('d M Y') }}

                                <br>

                                <small>

                                    {{ $booking->created_at->format('h:i A') }}

                                </small>

                            </td>

                            <td>

                                <a href="{{ route('admin.bookings.show',$booking->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                    View

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="10" class="text-center">

                                No Bookings Found

                            </td>

                        </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }}
                                of {{ $bookings->total() }} bookings
                            </small>

                            {{ $bookings->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

            </div>

        </div>

    </section>

</div>

@endcan

@cannot('bookings.view')

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid mt-3">

            <div class="alert alert-danger">

                You do not have permission to view bookings.

            </div>

        </div>

    </section>

</div>

@endcannot

@endsection
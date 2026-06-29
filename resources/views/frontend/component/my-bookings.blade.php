@extends('frontend.layout.app')

@section('content')

<section class="hero-wrap hero-wrap-2"
    style="background-image:url('{{ asset('UI/images/bg_3.jpg') }}');">

    <div class="overlay"></div>

    <div class="container">

        <div class="row slider-text align-items-end" style="height:300px;">

            <div class="col-md-9 pb-5">

                <h1 class="bread text-white">

                    My Bookings

                </h1>

            </div>

        </div>

    </div>

</section>

<section class="ftco-section bg-light">

    <div class="container">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="thead-dark">

                    <tr>

                        <th>#</th>
                        <th>Route</th>
                        <th>Date</th>
                        <th>Seats</th>
                        <th>Booking Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            {{ $booking->ride->pickup_location }}

                            <i class="fa fa-arrow-right mx-2"></i>

                            {{ $booking->ride->destination }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($booking->ride->travel_date)->format('d M Y') }}

                        </td>

                        <td>

                            {{ $booking->seats }}

                        </td>

                        <td>

                            @if($booking->booking_status == 'pending')

                            <span class="badge badge-warning">
                                Pending Approval
                            </span>

                            @elseif($booking->booking_status == 'accepted')

                            <span class="badge badge-success">
                                Accepted
                            </span>

                            @elseif($booking->booking_status == 'rejected')

                            <span class="badge badge-danger">
                                Rejected
                            </span>

                            @elseif($booking->booking_status == 'cancelled')

                            <span class="badge badge-secondary">
                                Cancelled
                            </span>

                            @endif

                        </td>

                        <td>

                            @if($booking->booking_status=='pending')

                            <form
                                action="{{ route('booking.cancel',$booking->id) }}"
                                method="POST">

                                @csrf

                                <button
                                    class="btn btn-danger btn-sm">

                                    Cancel

                                </button>

                            </form>

                            @else

                            -

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No Bookings Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>

@endsection
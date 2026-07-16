<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 pb-5">
                <h1 class="mb-3 bread">Ride Requests</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">

    <div class="container">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="thead-dark">

                    <tr>
                        <th>#</th>
                        <th>Passenger</th>
                        <th>Ride</th>
                        <th>Date</th>
                        <th>Seats</th>
                        <th>Status</th>
                        <th width="220">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $booking->user->name }}</strong><br>
                            <small>{{ $booking->user->email }}</small>
                        </td>

                        <td>
                            {{ $booking->ride->pickup_location }}
                            <br>
                            <strong>↓</strong>
                            <br>
                            {{ $booking->ride->destination }}
                        </td>

                        <td>{{ $booking->ride->travel_date }}</td>

                        <td>{{ $booking->seats }}</td>

                        <td>

                            @if($booking->status=='pending')

                            <span class="badge badge-warning">
                                Pending
                            </span>

                            @elseif($booking->status=='accepted')

                            <span class="badge badge-success">
                                Accepted
                            </span>

                            @elseif($booking->status=='rejected')

                            <span class="badge badge-danger">
                                Rejected
                            </span>

                            @endif

                        </td>

                        <td>

                            @if($booking->status=='pending')

                            <div class="d-flex">

                                <form action="{{ route('booking.accept',$booking->id) }}"
                                    method="POST"
                                    class="mr-2">

                                    @csrf

                                    <button class="btn btn-success btn-sm">

                                        Accept

                                    </button>

                                </form>

                                <form action="{{ route('booking.reject',$booking->id) }}"
                                    method="POST">

                                    @csrf

                                    <button class="btn btn-danger btn-sm">

                                        Reject

                                    </button>

                                </form>

                            </div>

                            @else

                            <span class="text-muted">
                                No Action
                            </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No booking requests yet.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>
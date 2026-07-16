<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
@extends('admin.frontend.webview.home')

@section('content')

@can('rides.view')
<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Ride Management</h1>

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

                        All Offered Rides

                    </h3>

                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Car</th>

                                <th>Driver</th>

                                <th>Route</th>

                                <th>Date</th>

                                <th>Fare</th>

                                <th>Seats</th>

                                <th>Bookings</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($rides as $ride)

                            <tr>

                                <td>

                                    {{ $ride->id }}

                                </td>

                                <td width="120">

                                    @if($ride->car && $ride->car->image)

                                    <img src="{{ asset('uploads/cars/'.$ride->car->image) }}"
                                        style="width:110px;height:70px;object-fit:cover;border-radius:8px;">

                                    @else

                                    <img src="{{ asset('UI/images/car-1.jpg') }}"
                                        style="width:110px;height:70px;object-fit:cover;border-radius:8px;">

                                    @endif

                                </td>

                                <td>

                                    <strong>

                                        {{ $ride->user->name }}

                                    </strong>

                                    <br>

                                    <small>

                                        {{ $ride->user->email }}

                                    </small>

                                </td>

                                <td>

                                    <strong>

                                        {{ $ride->pickup_location }}

                                    </strong>

                                    <br>

                                    <i class="fas fa-arrow-down text-success"></i>

                                    <br>

                                    <strong>

                                        {{ $ride->destination }}

                                    </strong>

                                </td>

                                <td>

                                    {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                                </td>


                                <td>

                                    ₹{{ number_format($ride->fare) }}

                                </td>

                                <td>

                                    {{ $ride->available_seats }}

                                </td>

                                <td>

                                    <span class="badge badge-info">

                                        {{ $ride->bookings->count() }}

                                    </span>

                                </td>

                                <td>

                                    @if($ride->status=="active")

                                    <span class="badge badge-success">

                                        Active

                                    </span>

                                    @elseif($ride->status=="completed")

                                    <span class="badge badge-primary">

                                        Completed

                                    </span>

                                    @else

                                    <span class="badge badge-danger">

                                        Cancelled

                                    </span>

                                    @endif

                                </td>

                                <td>

                                    @can('rides.view')
                                    <a href="{{ route('admin.rides.show',$ride->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                    @endcan

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="11" class="text-center">

                                    No rides found.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $rides->firstItem() }} to {{ $rides->lastItem() }}
                                of {{ $rides->total() }} rides
                            </small>

                            {{ $rides->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

            </div>

        </div>

    </section>

</div>
@endcan

@endsection
@extends('frontend.layout.app')

@section('content')

<section class="ftco-section">

    <div class="container">

        <h2 class="mb-5">

            My Offered Rides

        </h2>

        <div class="row">

            @forelse($rides as $ride)

            <div class="col-md-6">

                <div class="card mb-4 shadow">

                    <div class="card-body">

                        <h4>

                            {{ $ride->pickup_location }}

                            →

                            {{ $ride->destination }}

                        </h4>

                        <hr>

                        <p>

                            Travel Date:

                            {{ $ride->travel_date }}

                        </p>

                        <p>

                            Time:

                            {{ $ride->travel_time }}

                        </p>

                        <p>

                            Seats:

                            {{ $ride->available_seats }}

                        </p>

                        <p>

                            Fare:

                            ₹{{ $ride->fare }}

                        </p>

                        <span class="badge badge-success">

                            {{ ucfirst($ride->status) }}

                        </span>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-md-12">

                <div class="alert alert-info">

                    You haven't offered any rides yet.

                </div>

            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
@extends('frontend.layout.app')

@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight"
    style="background-image: url('{{ asset('UI') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">

    <div class="overlay"></div>

    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Available Rides</span>
                </p>

                <h1 class="mb-3 bread">Available Rides</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">

    <div class="container">

        @if($rides->count())

            @foreach($rides as $ride)

                <div class="card shadow-lg border-0 rounded mb-4">

                    <div class="card-body p-4">

                        <div class="row align-items-center">

                            <div class="col-md-2 text-center">

                                <h6 class="mt-3 mb-0">
                                    {{ $ride->user->name }}
                                </h6>

                            </div>

                            <div class="col-md-5">

                                <h5 class="font-weight-bold">

                                    {{ $ride->pickup_location }}

                                    <span class="text-success px-2">
                                        →
                                    </span>

                                    {{ $ride->destination }}

                                </h5>

                                <p class="mb-1">

                                    <i class="fa fa-calendar text-primary"></i>

                                    {{ \Carbon\Carbon::parse($ride->travel_date)->format('d M Y') }}

                                </p>

                                <p class="mb-1">

                                    <i class="fa fa-clock text-primary"></i>

                                    {{ date('h:i A', strtotime($ride->travel_time)) }}

                                </p>

                            </div>

                            <div class="col-md-2 text-center">

                                <h4 class="text-success">

                                    ₹{{ $ride->fare }}

                                </h4>

                                <small>per seat</small>

                            </div>

                            <div class="col-md-1 text-center">

                                <span class="badge badge-primary p-2">

                                    {{ $ride->available_seats }}

                                    Seats

                                </span>

                            </div>

                            <div class="col-md-2 text-center">

                                <a href="{{ route('rides.show',$ride->id) }}"
                                   class="btn btn-primary btn-block">

                                    View Ride

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        @else

            <div class="text-center py-5">

                <img src="{{ asset('frontend/images/no-data.png') }}"
                     width="220">

                <h3 class="mt-4">

                    No Rides Found

                </h3>

                <p class="text-muted">

                    Try changing the pickup, destination or date.

                </p>

                <a href="{{ route('home') }}"
                   class="btn btn-primary">

                    Search Again

                </a>

            </div>

        @endif

    </div>

</section>

@endsection
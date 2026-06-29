@extends('frontend.layout.app')

@section('content')

<section class="hero-wrap hero-wrap-2"
    style="background-image:url('{{ asset('UI/images/bg_3.jpg') }}')">

    <div class="overlay"></div>

    <div class="container">

        <div class="row slider-text align-items-end">

            <div class="col-md-9 pb-5">

                <h1 class="bread">

                    Driver Dashboard

                </h1>

            </div>

        </div>

    </div>

</section>

<section class="ftco-section bg-light">

    <div class="container">

        <h2 class="mb-5">

            Welcome,

            {{ auth()->user()->name }}

        </h2>

        <div class="row">

            <div class="col-md-3">

                <div class="card shadow text-center p-4">

                    <h5>Total Rides</h5>

                    <h2 class="text-success">

                        {{ $totalRides }}

                    </h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center p-4">

                    <h5>Pending Requests</h5>

                    <h2 class="text-warning">

                        {{ $pendingRequests }}

                    </h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center p-4">

                    <h5>Active Rides</h5>

                    <h2 class="text-primary">

                        {{ $activeRides }}

                    </h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center p-4">

                    <h5>Completed</h5>

                    <h2 class="text-success">

                        {{ $completedRides }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="row mt-5">

            <div class="col-md-8">

                <div class="card shadow">

                    <div class="card-header">

                        Recent Rides

                    </div>

                    <div class="card-body">

                        <table class="table">

                            <tr>

                                <th>Route</th>

                                <th>Date</th>

                                <th>Status</th>

                            </tr>

                            @foreach($recentRides as $ride)

                            <tr>

                                <td>

                                    {{ $ride->pickup_location }}

                                    →

                                    {{ $ride->destination }}

                                </td>

                                <td>

                                    {{ $ride->travel_date }}

                                </td>

                                <td>

                                    <span class="badge badge-success">

                                        {{ ucfirst($ride->status) }}

                                    </span>

                                </td>

                            </tr>

                            @endforeach

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow">

                    <div class="card-header">

                        Quick Actions

                    </div>

                    <div class="card-body">

                        <a href="{{ route('offer.ride') }}"
                            class="btn btn-success btn-block mb-3">

                            Offer Ride

                        </a>

                        <a href="{{ route('rides.my') }}"
                            class="btn btn-primary btn-block mb-3">

                            My Rides

                        </a>

                        <a href="{{ route('rides.requests') }}"
                            class="btn btn-warning btn-block mb-3">

                            Ride Requests

                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-dark btn-block">

                            Edit Profile

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
@extends('frontend.layout.app')



@section('style')
{{-- Page Specific CSS --}}
@endsection

@section('content')

@include('frontend.component.search')

@endsection

@section('script')
<script>
    const form = document.getElementById('searchForm');

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        let pickup = document.getElementById('pickup_location').value;

        let destination = document.getElementById('destination').value;

        let travel_date = document.getElementById('travel_date').value;

        fetch("{{ route('rides.search.js') }}?pickup_location=" + pickup + "&destination=" + destination + "&travel_date=" + travel_date)

            .then(res => res.json())

            .then(response => {

                let html = '';

                if (response.rides.length > 0) {

                    response.rides.forEach(function(ride) {

                        let image = ride.user.profile_image ?
                            '/uploads/profileimages/' + ride.user.profile_image :
                            '/uploads/profileimages/default.png';

                        html += `

<div class="card shadow-lg border-0 rounded mb-4">

<div class="card-body">

<div class="row align-items-center">

<div class="col-md-2 text-center">

<img src="${image}"
class="rounded-circle"
width="80"
height="80">

<h6 class="mt-2">${ride.user.name}</h6>

</div>

<div class="col-md-5">

<h5>

${ride.pickup_location}

<span class="text-success">→</span>

${ride.destination}

</h5>

<p>

<i class="fa fa-calendar"></i>

${ride.travel_date}

</p>

<p>

<i class="fa fa-clock"></i>

${ride.travel_time}

</p>

</div>

<div class="col-md-2 text-center">

<h4 class="text-success">

₹${ride.fare}

</h4>

</div>

<div class="col-md-1 text-center">

<span class="badge badge-primary">

${ride.available_seats} Seats

</span>

</div>

<div class="col-md-2">

<a href="/rides/${ride.id}"
class="btn btn-primary btn-block">

View Ride

</a>

</div>

</div>

</div>

</div>

`;

                    });

                } else {

                    html = `

<div class="text-center py-5">

<h3>No Rides Found</h3>

<p>Try another search.</p>

</div>

`;

                }

                document.getElementById('rideList').innerHTML = html;

            });

    });
</script>
@endsection
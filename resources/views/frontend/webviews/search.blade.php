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

        fetch("{{ route('rides.search.js') }}?pickup_location=" + encodeURIComponent(pickup) + "&destination=" + encodeURIComponent(destination) + "&travel_date=" + travel_date)

            .then(res => res.json())

            .then(response => {

                let html = '';

                if (response.rides.length > 0) {

                    response.rides.forEach(function(ride) {

                        let image = ride.user.profile_image ?
                            '/uploads/profileimages/' + ride.user.profile_image :
                            '/uploads/profileimages/default.png';

                        let parsedDate = new Date(ride.travel_date);
                        let dateOptions = { day: '2-digit', month: 'short', year: 'numeric' };
                        let formattedDate = parsedDate.toLocaleDateString('en-GB', dateOptions);

                        let today = new Date();
                        today.setHours(0,0,0,0);
                        parsedDate.setHours(0,0,0,0);

                        let buttonHtml = '';
                        if (parsedDate < today) {
                            buttonHtml = `
                                <button class="btn btn-secondary btn-block" disabled>
                                    <i class="fa fa-ban mr-1"></i> Ride Expired
                                </button>
                            `;
                        } else {
                            buttonHtml = `
                                <a href="/rides/${ride.id}" class="btn btn-primary btn-block">
                                    View Ride
                                </a>
                            `;
                        }

                        let durationHtml = ride.duration 
                            ? `<span class="badge badge-warning text-dark px-2 py-1 ml-3" style="font-size: 12px; font-weight: 600;"><i class="fa fa-clock-o mr-1"></i>${ride.duration}</span>` 
                            : '';

                        html += `
<div class="card shadow-lg border-0 rounded mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-2 text-center">
                <img src="${image}"
                    class="rounded-circle shadow mb-2"
                    width="80"
                    height="80"
                    style="object-fit:cover;border:2px solid #ddd;">
                <h6 class="mt-2 mb-0">${ride.user.name}</h6>
            </div>
            <div class="col-md-5">
                <div class="route-line mb-3">
                    <span class="route-city">${ride.pickup_location}</span>
                    <span class="route-dot"></span>
                    <span class="route-dash"></span>
                    <span class="route-dot"></span>
                    <span class="route-city">${ride.destination}</span>
                </div>
                <div class="d-flex align-items-center">
                    <span>
                        <i class="fa fa-calendar text-primary mr-1"></i>
                        ${formattedDate}
                    </span>
                    ${durationHtml}
                </div>
            </div>
            <div class="col-md-2 text-center">
                <h4 class="text-success">₹${ride.fare}</h4>
                <small>per seat</small>
            </div>
            <div class="col-md-1 text-center">
                <span class="badge badge-primary p-2">
                    ${ride.available_seats} Seats
                </span>
            </div>
            <div class="col-md-2 text-center">
                ${buttonHtml}
            </div>
        </div>
    </div>
</div>
`;

                    });

                } else {

                    html = `
<div class="text-center py-5">
    <h3 class="mt-4">No Rides Found</h3>
    <p class="text-muted">Try changing the pickup, destination or date.</p>
</div>
`;

                }

                document.getElementById('rideList').innerHTML = html;

            });

    });
</script>
@endsection
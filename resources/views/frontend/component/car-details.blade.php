

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight"
	style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');"
	data-stellar-background-ratio="0.5">

	<div class="overlay"></div>

	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs">
					<span class="mr-2">
						<a href="{{ route('home') }}">
							Home
							<i class="ion-ios-arrow-forward"></i>
						</a>
					</span>

					<span>
						{{ $car->car_name }}
						<i class="ion-ios-arrow-forward"></i>
					</span>
				</p>

				<h1 class="mb-3 bread">
					{{ $car->car_name }}
				</h1>
			</div>
		</div>
	</div>

</section>

<!-- Car Details -->
<section class="ftco-section">
	<div class="container">

		<div class="row">

			<!-- Image -->
			<div class="col-lg-6 ftco-animate">

				<div class="car-wrap rounded shadow">

					@if($car->image)

					<img src="{{ asset('uploads/cars/'.$car->image) }}"
						class="img-fluid rounded"
						style="width:100%;height:450px;object-fit:cover;">

					@else

					<img src="{{ asset('UI/images/car-1.jpg') }}"
						class="img-fluid rounded"
						style="width:100%;height:450px;object-fit:cover;">

					@endif

				</div>

			</div>

			<!-- Details -->
			<div class="col-lg-6 ftco-animate">

				<h2 class="mb-4">
					{{ $car->car_name }}
				</h2>

				<table class="table table-bordered">

					<tr>
						<th width="35%">Brand</th>
						<td>{{ $car->brand }}</td>
					</tr>

					<tr>
						<th>Model</th>
						<td>{{ $car->model }}</td>
					</tr>

					<tr>
						<th>Registration No.</th>
						<td>{{ $car->registration_number }}</td>
					</tr>

					<tr>
						<th>Manufacturing Year</th>
						<td>{{ $car->manufacturing_year }}</td>
					</tr>

					<tr>
						<th>Fuel Type</th>
						<td>{{ $car->fuel_type }}</td>
					</tr>

					<tr>
						<th>Transmission</th>
						<td>{{ $car->transmission }}</td>
					</tr>

					<tr>
						<th>Color</th>
						<td>{{ $car->color }}</td>
					</tr>

					<tr>
						<th>Owner</th>
						<td>{{ $car->user->name }}</td>
					</tr>

					<tr>
						<th>Contact</th>
						<td>{{ $car->user->phone }}</td>
					</tr>

				</table>

				<!-- Pricing -->

				<div class="bg-light p-4 rounded shadow-sm mt-4">

					<h5 class="mb-3">Rental Price</h5>

					<h2 class="text-primary mb-2">
						₹{{ number_format($car->rent_per_day, 2) }}
						<small class="text-dark">/ Day</small>
					</h2>

				</div>

                @php
                    $ride = \App\Models\Ride::where('car_id', $car->id)->first();
                @endphp
				<div class="mt-5">
                    @if($ride)
                        <a href="{{ route('booking.summary', $ride->id) }}"
                            class="btn btn-primary py-3 px-5">
                            Book Now
                        </a>
                    @else
                        <button class="btn btn-primary py-3 px-5" disabled>
                            Not Available for Booking
                        </button>
                    @endif
				</div>

			</div>

		</div>

		<!-- Description -->

		<div class="row mt-5">

			<div class="col-md-12 ftco-animate">

				<div class="bg-light p-5 rounded">

					<h3>Description</h3>

					<hr>

					<p class="mb-0">

						{{ $car->description }}

					</p>

				</div>

			</div>

		</div>

	</div>
</section>

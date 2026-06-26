@extends('frontend.layouts.app')

@section('content')

<section class="ftco-section">

	<div class="container">

		<div class="row">

			<div class="col-md-6">

				@if($car->image)

				<img
					src="{{ asset('uploads/cars/'.$car->image) }}"
					class="img-fluid rounded shadow">

				@else

				<img
					src="{{ asset('UI/images/car-1.jpg') }}"
					class="img-fluid rounded shadow">

				@endif

			</div>

			<div class="col-md-6">

				<h2>{{ $car->car_name }}</h2>

				<hr>

				<p><strong>Brand :</strong> {{ $car->brand }}</p>

				<p><strong>Model :</strong> {{ $car->model }}</p>

				<p><strong>Registration :</strong> {{ $car->registration_number }}</p>

				<p><strong>Year :</strong> {{ $car->manufacturing_year }}</p>

				<p><strong>Fuel :</strong> {{ $car->fuel_type }}</p>

				<p><strong>Transmission :</strong> {{ $car->transmission }}</p>

				<p><strong>Color :</strong> {{ $car->color }}</p>

				<p><strong>Owner :</strong> {{ $car->user->name }}</p>

				<p><strong>Contact :</strong> {{ $car->user->phone }}</p>

				<h3 class="text-primary">

					₹{{ number_format($car->rent_per_day) }}

					<small>/Day</small>

				</h3>

				<hr>

				<h5>Description</h5>

				<p>

					{{ $car->description }}

				</p>

				<a href="#"

					class="btn btn-primary">

					Book Now

				</a>

			</div>

		</div>

	</div>

</section>

@endsection
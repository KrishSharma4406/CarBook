<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Choose Your Car</h1>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">

			@forelse($cars as $car)

			<div class="col-md-4">

				<div class="car-wrap rounded ftco-animate">

					<div class="img rounded d-flex align-items-end"
						style="background-image:url('{{ $car->image ? asset('uploads/cars/'.$car->image) : '' }}');">

					</div>

					<div class="text">

						<h2 class="mb-0">

							<a href="{{ route('car.show',$car->id) }}">

								{{ $car->car_name }}

							</a>

						</h2>

						<div class="d-flex mb-3">

							<span class="cat">

								{{ $car->brand }}

								{{ $car->model }}

							</span>

							<p class="price ml-auto">

								₹{{ $car->rent_per_day }}

								<span>/day</span>

							</p>

						</div>

						<p>

							<strong>Owner:</strong>

							{{ $car->user->name }}

						</p>

						<p>

							<strong>Fuel:</strong>

							{{ $car->fuel_type }}

						</p>

						<p>

							<strong>Transmission:</strong>

							{{ $car->transmission }}

						</p>

						<p>

							<strong>Color:</strong>

							{{ $car->color }}

						</p>

						<p class="d-flex mb-0 d-block">

							<a href="{{ route('booking.summary',$rides->id) }}"
								class="btn btn-primary py-2 mr-1">

								Book Now

							</a>

							<a href="{{ route('car.show',$car->id) }}"
								class="btn btn-secondary py-2 ml-1">

								Details

							</a>

						</p>

					</div>

				</div>

			</div>

			@empty

			<div class="col-12 text-center">

				<h3>No Cars Available</h3>

			</div>

			@endforelse

		</div>

		<div class="row mt-5">

			<div class="col text-center">

				{{ $cars->links() }}

			</div>

		</div>
		<div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					<ul>
						<li><a href="#">&lt;</a></li>
						<li class="active"><span>1</span></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&gt;</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI') }}/images/bg_3.jpg');"
	data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
								class="ion-ios-arrow-forward"></i></a></span> <span>Pricing <i
							class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">

					Rental Pricing

				</h1>

				<p class="text-white">

					Choose the perfect car for your next journey.

				</p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="car-list shadow rounded p-4 bg-white">
					<table class="table table-hover shadow rounded bg-white">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>Car Details</th>
								<th class="bg-primary heading">Rental Price (Per Day)</th>
							</tr>
						</thead>
						<tbody>

							@forelse($cars as $car)

										<tr class="text-center">

											<td class="car-image">
												<div class="img rounded" style="background-image:url('{{ asset('uploads/cars/' . $car->image) }}');
								width:180px;
								height:120px;
								background-size:cover;
								background-position:center;">
												</div>
											</td>

											<td class="product-name text-left">

												<h4 class="mb-2">
													{{ $car->car_name }}
												</h4>

												<p class="mb-1">
													<strong>Brand:</strong>
													{{ $car->brand }}
												</p>

												<p class="mb-1">
													<strong>Model:</strong>
													{{ $car->model }}
												</p>

												<p class="mb-1">
													<strong>Fuel:</strong>
													{{ $car->fuel_type }}
												</p>

												<p class="mb-2">
													<strong>Transmission:</strong>
													{{ $car->transmission }}
												</p>

												<div class="rated">

													<span class="text-warning">
														★★★★★
													</span>

												</div>

											</td>

											<td class="price">

												<div class="price-rate mb-3">

													<h2 class="text-primary">

														₹{{ number_format($car->rent_per_day) }}

													</h2>

													<span class="text-muted">
														Per Day
													</span>

												</div>

												<a href="{{ route('car.show', $car->id) }}" class="btn btn-primary px-4 py-2">

													Rent Now

												</a>

											</td>

										</tr>

							@empty

								<tr>

									<td colspan="3" class="text-center py-5">

										<h4>No Cars Available</h4>

									</td>

								</tr>

							@endforelse

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
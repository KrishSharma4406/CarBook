    <!-- END nav -->

    <div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ $home->hero_background ? asset($home->hero_background) : '' }}');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
    			<div class="col-lg-8 ftco-animate">
    				<div class="text w-100 text-center mb-md-5 pb-md-5">
    					<h1 class="mb-4">{{ $home->hero_title }}</h1>
    					<p style="font-size: 18px;">{{ $home->hero_subtitle }}</p>
    					<a href="{{ $home->video_url }}" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
    						<div class="icon d-flex align-items-center justify-content-center">
    							<span class="ion-ios-play"></span>
    						</div>
    						<div class="heading-title ml-5">
    							<span>{{ $home->video_text }}</span>
    						</div>
    					</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12	featured-top">
    				<div class="row no-gutters">
    					<div class="col-md-4 d-flex align-items-center">
    						<form action="{{ route('rides.search') }}" method="GET" class="request-form ftco-animate bg-primary">

    							<h2>Make your trip</h2>

    							<div class="form-group">
    								<label class="label">Pick-up location</label>

    								<input type="text"
    									name="pickup_location"
    									class="form-control"
    									placeholder="City, Airport, Station, etc">
    							</div>

    							<div class="form-group">
    								<label class="label">Drop-off location</label>

    								<input type="text"
    									name="destination"
    									class="form-control"
    									placeholder="City, Airport, Station, etc">
    							</div>

								<div class="d-flex">
									<div class="form-group mr-2 w-100">
										<label class="label">Pick-up date</label>
										<input type="text"
											name="travel_date"
											class="form-control"
											id="book_pick_date"
											placeholder="Date">
									</div>
									<div class="form-group ml-2 w-100">
										<label class="label">Pick-up time</label>
										<input type="text"
											name="travel_time"
											class="form-control"
											id="time_pick"
											placeholder="Time"
											required>
									</div>
								</div>

								<div class="form-group">
									<input type="submit"
										value="Rent A Car Now"
										class="btn btn-secondary py-3 px-4 btn-block">
								</div>

    						</form>
    					</div>
    					<div class="col-md-8 d-flex align-items-center">
    						<div class="services-wrap rounded-right w-100">
								<h3 class="heading-section mb-4">{{ $home->rent_title ?? 'Better Way to Rent Your Perfect Cars' }}</h3>
								<div class="row d-flex mb-4">
									<div class="col-md-4 d-flex align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="{{ $home->rent_step_1_icon ?? 'flaticon-route' }}"></span>
											</div>
											<div class="text w-100">
												<h3 class="heading mb-2">{{ $home->rent_step_1_title ?? 'Choose Your Pickup Location' }}</h3>
											</div>
										</div>
									</div>
									<div class="col-md-4 d-flex align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="{{ $home->rent_step_2_icon ?? 'flaticon-handshake' }}"></span>
											</div>
											<div class="text w-100">
												<h3 class="heading mb-2">{{ $home->rent_step_2_title ?? 'Select the Best Deal' }}</h3>
											</div>
										</div>
									</div>
									<div class="col-md-4 d-flex justify-content-center align-self-stretch ftco-animate">
										<div class="services w-100 text-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="{{ $home->rent_step_3_icon ?? 'flaticon-rent' }}"></span>
											</div>
											<div class="text w-100 text-center mx-auto m-auto">
												<h3 class="heading mb-2 text-center">{{ $home->rent_step_3_title ?? 'Reserve Your Rental Car' }}</h3>
											</div>
										</div>
									</div>
								</div>
								<p class="mt-5">
									<a href="{{ $home->rent_button_url ?? '#' }}" class="btn btn-primary py-3 px-4">{{ $home->rent_button_text ?? 'Reserve Your Perfect Car' }}</a>
								</p>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    </section>


    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
    				<span class="subheading">What we offer</span>
    				<h2 class="mb-2">Featured Vehicles</h2>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="row">
    					@forelse($cars as $car)

    					<div class="col-md-4 mb-4">
    						<div class="car-wrap rounded ftco-animate">

    							<div class="img rounded d-flex align-items-end"
    								style="background-image: url('{{ $car->image ? asset("uploads/cars/" . $car->image) : asset('UI/images/car-1.jpg') }}');">
    							</div>

    							<div class="text">

    								<h2 class="mb-0">
    									<a href="#">{{ $car->car_name }}</a>
    								</h2>

    								<div class="d-flex mb-2">
    									<span class="cat">{{ $car->brand }}</span>

    									<p class="price ml-auto">
    										₹{{ number_format($car->rent_per_day) }}
    										<span>/day</span>
    									</p>
    								</div>

    								<ul class="list-unstyled mb-3">
    									<li><strong>Model:</strong> {{ $car->model }}</li>
    									<li><strong>Fuel:</strong> {{ $car->fuel_type }}</li>
    									<li><strong>Transmission:</strong> {{ $car->transmission }}</li>
    									<li><strong>Owner:</strong> {{ $car->user->name }}</li>
    								</ul>

                                    @php
                                        $ride = \App\Models\Ride::where('car_id', $car->id)->first();
                                    @endphp
    								<p class="d-flex mb-0">
                                        @if($ride)
                                            <a href="{{ route('booking.summary', $ride->id) }}" class="btn btn-primary py-2 mr-1">
                                                Book Now
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-primary py-2 mr-1 disabled" style="pointer-events: none; opacity: 0.6;">
                                                Book Now
                                            </a>
                                        @endif

    									<a href="{{ route('car.show',$car->id) }}"
    										class="btn btn-secondary py-2 ml-1">

    										Details

    									</a>

    								</p>

    							</div>

    						</div>
    					</div>

    					@empty

    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
    							<div class="text text-center p-5">
    								<h4>No Cars Available</h4>
    							</div>
    						</div>
    					</div>

    					@endforelse

    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    @if($home->about_title || $home->about_description)
    <section class="ftco-section ftco-about">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ $home->about_image ? asset($home->about_image) : '' }});">
    			</div>
    			<div class="col-md-6 wrap-about ftco-animate">
    				<div class="heading-section heading-section-white pl-md-5">
    					<span class="subheading">{{ $home->about_subtitle ?? '' }}</span>
    					<h2 class="mb-4">{{ $home->about_title ?? '' }}</h2>

    					<p>{{ $home->about_description ?? '' }}</p>
    					<p><a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    @endif

    @if($home->services_title || $home->service_1_title || $home->service_2_title || $home->service_3_title || $home->service_4_title)
    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
    			<div class="col-md-7 text-center heading-section ftco-animate">
    				<span class="subheading">{{ $home->services_subtitle ?? '' }}</span>
    				<h2 class="mb-3">{{ $home->services_title ?? '' }}</h2>
    			</div>
    		</div>
    		<div class="row">
    			@if($home->service_1_title)
    			<div class="col-md-3">
    				<div class="services services-2 w-100 text-center">
    					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $home->service_1_icon ?? '' }}"></span></div>
    					<div class="text w-100">
    						<h3 class="heading mb-2">{{ $home->service_1_title ?? '' }}</h3>
    						<p>{{ $home->service_1_desc ?? '' }}</p>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->service_2_title)
    			<div class="col-md-3">
    				<div class="services services-2 w-100 text-center">
    					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $home->service_2_icon ?? '' }}"></span></div>
    					<div class="text w-100">
    						<h3 class="heading mb-2">{{ $home->service_2_title ?? '' }}</h3>
    						<p>{{ $home->service_2_desc ?? '' }}</p>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->service_3_title)
    			<div class="col-md-3">
    				<div class="services services-2 w-100 text-center">
    					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $home->service_3_icon ?? '' }}"></span></div>
    					<div class="text w-100">
    						<h3 class="heading mb-2">{{ $home->service_3_title ?? '' }}</h3>
    						<p>{{ $home->service_3_desc ?? '' }}</p>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->service_4_title)
    			<div class="col-md-3">
    				<div class="services services-2 w-100 text-center">
    					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $home->service_4_icon ?? '' }}"></span></div>
    					<div class="text w-100">
    						<h3 class="heading mb-2">{{ $home->service_4_title ?? '' }}</h3>
    						<p>{{ $home->service_4_desc ?? '' }}</p>
    					</div>
    				</div>
    			</div>
    			@endif
    		</div>
    	</div>
    </section>
    @endif

    @if($home->cta_title)
    <section class="ftco-section ftco-intro" style="background-image: url({{ $home->cta_background ? asset($home->cta_background) : '' }});">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-end">
    			<div class="col-md-6 heading-section heading-section-white ftco-animate">
    				<h2 class="mb-3">{{ $home->cta_title ?? '' }}</h2>
    				<a href="{{ $home->cta_button_url ?? '#' }}" class="btn btn-primary btn-lg">{{ $home->cta_button_text ?? '' }}</a>
    			</div>
    		</div>
    	</div>
    </section>
    @endif


    @if($home->testimonial_title)
    <section class="ftco-section testimony-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
    			<div class="col-md-7 text-center heading-section ftco-animate">
    				<span class="subheading">{{ $home->testimonial_subtitle ?? '' }}</span>
    				<h2 class="mb-3">{{ $home->testimonial_title ?? '' }}</h2>
    			</div>
    		</div>
    		<div class="row ftco-animate">
    			<div class="col-md-12">
    				<div class="carousel-testimony owl-carousel ftco-owl">
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    @endif

    @if($home->blog_title)
    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
    			<div class="col-md-7 heading-section text-center ftco-animate">
    				<span class="subheading">{{ $home->blog_subtitle ?? '' }}</span>
    				<h2>{{ $home->blog_title ?? '' }}</h2>
    			</div>
    		</div>
    		<div class="row d-flex">
    			@foreach($blogs as $post)
    			<div class="col-md-4 d-flex ftco-animate">
    				<div class="blog-entry justify-content-end">
    					<a href="{{ route('blog-details', $post->slug) }}" class="block-20" style="background-image: url('{{ $post->image ? asset($post->image) : '' }}');">
    					</a>
    					<div class="text pt-4">
    						<div class="meta mb-3">
    							<div><a href="#">{{ $post->created_at->format('M. d, Y') }}</a></div>
    							<div><a href="#">{{ $post->author }}</a></div>
    						</div>
    						<h3 class="heading mt-2"><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a></h3>
    						<p><a href="{{ route('blog-details', $post->slug) }}" class="btn btn-primary">Read more</a></p>
    					</div>
    				</div>
    			</div>
    			@endforeach
    		</div>
    	</div>
    </section>
    @endif

    @if($home->counter_1_number || $home->counter_2_number || $home->counter_3_number || $home->counter_4_number)
    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
    			@if($home->counter_1_number)
    			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    				<div class="block-18">
    					<div class="text text-border d-flex align-items-center">
    						<strong class="number" data-number="{{ $home->counter_1_number ?? 0 }}">0</strong>
    						<span>{!! nl2br(e($home->counter_1_label ?? "")) !!}</span>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->counter_2_number)
    			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    				<div class="block-18">
    					<div class="text text-border d-flex align-items-center">
    						<strong class="number" data-number="{{ $home->counter_2_number ?? 0 }}">0</strong>
    						<span>{!! nl2br(e($home->counter_2_label ?? "")) !!}</span>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->counter_3_number)
    			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    				<div class="block-18">
    					<div class="text text-border d-flex align-items-center">
    						<strong class="number" data-number="{{ $home->counter_3_number ?? 0 }}">0</strong>
    						<span>{!! nl2br(e($home->counter_3_label ?? "")) !!}</span>
    					</div>
    				</div>
    			</div>
    			@endif
    			@if($home->counter_4_number)
    			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    				<div class="block-18">
    					<div class="text d-flex align-items-center">
    						<strong class="number" data-number="{{ $home->counter_4_number ?? 0 }}">0</strong>
    						<span>{!! nl2br(e($home->counter_4_label ?? "")) !!}</span>
    					</div>
    				</div>
    			</div>
    			@endif
    		</div>
    	</div>
    </section>
    @endif
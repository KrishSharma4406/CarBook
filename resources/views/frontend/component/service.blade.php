@if($services->hero_title)
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $services->hero_background ? asset($services->hero_background) : '' }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
      	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Services <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">{{ $services->hero_title ?? '' }}</h1>
      </div>
    </div>
  </div>
</section>
@endif

@if($services->services_title || $services->service_1_title || $services->service_2_title || $services->service_3_title || $services->service_4_title)
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<span class="subheading">{{ $services->services_subtitle ?? '' }}</span>
				<h2 class="mb-3">{{ $services->services_title ?? '' }}</h2>
			</div>
		</div>
		<div class="row">
			@if($services->service_1_title)
			<div class="col-md-3">
				<div class="services services-2 w-100 text-center">
					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $services->service_1_icon ?? '' }}"></span></div>
					<div class="text w-100">
						<h3 class="heading mb-2">{{ $services->service_1_title ?? '' }}</h3>
						<p>{{ $services->service_1_desc ?? '' }}</p>
					</div>
				</div>
			</div>
			@endif
			@if($services->service_2_title)
			<div class="col-md-3">
				<div class="services services-2 w-100 text-center">
					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $services->service_2_icon ?? '' }}"></span></div>
					<div class="text w-100">
						<h3 class="heading mb-2">{{ $services->service_2_title ?? '' }}</h3>
						<p>{{ $services->service_2_desc ?? '' }}</p>
					</div>
				</div>
			</div>
			@endif
			@if($services->service_3_title)
			<div class="col-md-3">
				<div class="services services-2 w-100 text-center">
					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $services->service_3_icon ?? '' }}"></span></div>
					<div class="text w-100">
						<h3 class="heading mb-2">{{ $services->service_3_title ?? '' }}</h3>
						<p>{{ $services->service_3_desc ?? '' }}</p>
					</div>
				</div>
			</div>
			@endif
			@if($services->service_4_title)
			<div class="col-md-3">
				<div class="services services-2 w-100 text-center">
					<div class="icon d-flex align-items-center justify-content-center"><span class="{{ $services->service_4_icon ?? '' }}"></span></div>
					<div class="text w-100">
						<h3 class="heading mb-2">{{ $services->service_4_title ?? '' }}</h3>
						<p>{{ $services->service_4_desc ?? '' }}</p>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</section>
@endif

@if($services->cta_title)
<section class="ftco-section ftco-intro" style="background-image: url({{ $services->cta_background ? asset($services->cta_background) : '' }});">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-6 heading-section heading-section-white ftco-animate">
				<h2 class="mb-3">{{ $services->cta_title ?? '' }}</h2>
				<a href="{{ $services->cta_button_url ?? '#' }}" class="btn btn-primary btn-lg">{{ $services->cta_button_text ?? '' }}</a>
			</div>
		</div>
	</div>
</section>
@endif

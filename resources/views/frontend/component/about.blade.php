@if($about->hero_title)
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $about->hero_background ? asset($about->hero_background) : '' }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
      	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">{{ $about->hero_title ?? '' }}</h1>
      </div>
    </div>
  </div>
</section>
@endif

@if($about->about_title || $about->about_description)
<section class="ftco-section ftco-about">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ $about->about_image ? asset($about->about_image) : '' }});">
			</div>
			<div class="col-md-6 wrap-about ftco-animate">
				<div class="heading-section heading-section-white pl-md-5">
					<span class="subheading">{{ $about->about_subtitle ?? '' }}</span>
					<h2 class="mb-4">{{ $about->about_title ?? '' }}</h2>
					<p>{{ $about->about_description ?? '' }}</p>
					<p><a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
				</div>
			</div>
		</div>
	</div>
</section>
@endif

@if($about->cta_title)
<section class="ftco-section ftco-intro" style="background-image: url({{ $about->cta_background ? asset($about->cta_background) : '' }});">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-6 heading-section heading-section-white ftco-animate">
				<h2 class="mb-3">{{ $about->cta_title ?? '' }}</h2>
				<a href="{{ $about->cta_button_url ?? '#' }}" class="btn btn-primary btn-lg">{{ $about->cta_button_text ?? '' }}</a>
			</div>
		</div>
	</div>
</section>
@endif

@if($about->testimonial_title)
<section class="ftco-section testimony-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
      	<span class="subheading">{{ $about->testimonial_subtitle ?? '' }}</span>
        <h2 class="mb-3">{{ $about->testimonial_title ?? '' }}</h2>
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

@if($about->counter_1_number || $about->counter_2_number || $about->counter_3_number || $about->counter_4_number)
<section class="ftco-counter ftco-section img" id="section-counter">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			@if($about->counter_1_number)
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="{{ $about->counter_1_number ?? 0 }}">0</strong>
						<span>{!! nl2br(e($about->counter_1_label ?? "")) !!}</span>
					</div>
				</div>
			</div>
			@endif
			@if($about->counter_2_number)
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="{{ $about->counter_2_number ?? 0 }}">0</strong>
						<span>{!! nl2br(e($about->counter_2_label ?? "")) !!}</span>
					</div>
				</div>
			</div>
			@endif
			@if($about->counter_3_number)
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="{{ $about->counter_3_number ?? 0 }}">0</strong>
						<span>{!! nl2br(e($about->counter_3_label ?? "")) !!}</span>
					</div>
				</div>
			</div>
			@endif
			@if($about->counter_4_number)
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text d-flex align-items-center">
						<strong class="number" data-number="{{ $about->counter_4_number ?? 0 }}">0</strong>
						<span>{!! nl2br(e($about->counter_4_label ?? "")) !!}</span>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</section>
@endif
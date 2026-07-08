@if($contact->hero_title)
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $contact->hero_background ? asset($contact->hero_background) : '' }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">{{ $contact->hero_title ?? '' }}</h1>
          </div>
        </div>
      </div>
    </section>
@endif

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          @if($contact->contact_address || $contact->contact_phone || $contact->contact_email)
        	<div class="col-md-4">
        		<div class="row mb-5">
        		  @if($contact->contact_address)
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-map-o"></span>
			          	</div>
			            <p><span>Address:</span> {{ $contact->contact_address }}</p>
			          </div>
		          </div>
		          @endif
		          @if($contact->contact_phone)
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-mobile-phone"></span>
			          	</div>
			            <p><span>Phone:</span> <a href="tel:{{ $contact->contact_phone }}">{{ $contact->contact_phone }}</a></p>
			          </div>
		          </div>
		          @endif
		          @if($contact->contact_email)
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-envelope-o"></span>
			          	</div>
			            <p><span>Email:</span> <a href="mailto:{{ $contact->contact_email }}">{{ $contact->contact_email }}</a></p>
			          </div>
		          </div>
		          @endif
		        </div>
          </div>
          @endif
          <div class="col-md-8 block-9 mb-md-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="bg-light p-5 contact-form">
              @csrf
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required>
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}" required>
              </div>
              <div class="form-group">
                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>
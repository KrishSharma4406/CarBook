<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $post->image ? asset($post->image) : '' }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
      	<p class="breadcrumbs">
          <span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
          <span class="mr-2"><a href="{{ route('blog') }}">Blog <i class="ion-ios-arrow-forward"></i></a></span> 
          <span>Blog Details <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-3 bread">{{ $post->title }}</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-degree-bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 ftco-animate">
        <h2 class="mb-3">{{ $post->title }}</h2>
        <div class="meta-wrap mb-4">
          <p class="meta text-muted">
            <span><i class="icon-calendar mr-1"></i>{{ $post->created_at->format('M. d, Y') }}</span>
            <span class="ml-3"><i class="icon-person mr-1"></i>Posted by {{ $post->author }}</span>
          </p>
        </div>
        
        @if($post->image)
        <p class="text-center">
          <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
        </p>
        @endif

        <div class="content-body mt-5" style="font-size: 18px; line-height: 1.8; color: #666;">
          {!! nl2br(e($post->content)) !!}
        </div>
      </div>
    </div>
  </div>
</section>
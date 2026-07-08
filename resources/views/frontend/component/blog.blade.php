@if($blog->hero_title)
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $blog->hero_background ? asset($blog->hero_background) : '' }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">{{ $blog->hero_title ?? '' }}</h1>
          </div>
        </div>
      </div>
    </section>
@endif

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex justify-content-center">
          @forelse($blogs as $post)
          <div class="col-md-12 text-center d-flex ftco-animate">
          	<div class="blog-entry justify-content-end mb-md-5">
              <a href="{{ route('blog-details', $post->slug) }}" class="block-20 img" style="background-image: url('{{ $post->image ? asset($post->image) : '' }}');">
              </a>
              <div class="text px-md-5 pt-4">
              	<div class="meta mb-3">
                  <div><a href="#">{{ $post->created_at->format('M. d, Y') }}</a></div>
                  <div><a href="#">{{ $post->author }}</a></div>
                </div>
                <h3 class="heading mt-2"><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a></h3>
                <p>{{ $post->description }}</p>
                <p><a href="{{ route('blog-details', $post->slug) }}" class="btn btn-primary">Continue <span class="icon-long-arrow-right"></span></a></p>
              </div>
            </div>
          </div>
          @empty
          <div class="col-md-12 text-center">
              <p class="lead text-muted">No blog posts have been uploaded yet.</p>
          </div>
          @endforelse
        </div>
        
        @if($blogs->hasPages())
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27 d-flex justify-content-center">
              {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>
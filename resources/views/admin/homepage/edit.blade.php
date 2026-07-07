@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Home Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.homepage.index') }}">Home Page</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ===== HERO SECTION ===== --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-image mr-2"></i>Hero Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_title">Hero Title <span class="text-danger">*</span></label>
                                    <input type="text" name="hero_title" id="hero_title"
                                        class="form-control @error('hero_title') is-invalid @enderror"
                                        value="{{ old('hero_title', $home->hero_title) }}" required>
                                    @error('hero_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video_url">Video URL</label>
                                    <input type="text" name="video_url" id="video_url"
                                        class="form-control"
                                        value="{{ old('video_url', $home->video_url) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hero_subtitle">Hero Subtitle</label>
                            <textarea name="hero_subtitle" id="hero_subtitle" rows="2"
                                class="form-control">{{ old('hero_subtitle', $home->hero_subtitle) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video_text">Video Button Text</label>
                                    <input type="text" name="video_text" id="video_text"
                                        class="form-control"
                                        value="{{ old('video_text', $home->video_text) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_background">Hero Background Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="hero_background" id="hero_background"
                                                class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label" for="hero_background">Choose file</label>
                                        </div>
                                    </div>
                                    @if($home->hero_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($home->hero_background) }}" target="_blank">{{ basename($home->hero_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== ABOUT SECTION ===== --}}
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>About Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_subtitle">Subtitle</label>
                                    <input type="text" name="about_subtitle" id="about_subtitle"
                                        class="form-control"
                                        value="{{ old('about_subtitle', $home->about_subtitle) }}"
                                        placeholder="e.g. About us">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_title">Title</label>
                                    <input type="text" name="about_title" id="about_title"
                                        class="form-control"
                                        value="{{ old('about_title', $home->about_title) }}"
                                        placeholder="e.g. Welcome to Carbook">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about_description">Description</label>
                            <textarea name="about_description" id="about_description" rows="4"
                                class="form-control"
                                placeholder="About section description...">{{ old('about_description', $home->about_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_image">About Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="about_image" id="about_image"
                                        class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="about_image">Choose file</label>
                                </div>
                            </div>
                            @if($home->about_image)
                                <small class="text-muted mt-1 d-block">
                                    Current: <a href="{{ asset($home->about_image) }}" target="_blank">{{ basename($home->about_image) }}</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ===== SERVICES SECTION ===== --}}
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-concierge-bell mr-2"></i>Services Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="services_subtitle">Section Subtitle</label>
                                    <input type="text" name="services_subtitle" id="services_subtitle"
                                        class="form-control"
                                        value="{{ old('services_subtitle', $home->services_subtitle) }}"
                                        placeholder="e.g. Services">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="services_title">Section Title</label>
                                    <input type="text" name="services_title" id="services_title"
                                        class="form-control"
                                        value="{{ old('services_title', $home->services_title) }}"
                                        placeholder="e.g. Our Latest Services">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3">Individual Services</h5>

                        @for($i = 1; $i <= 4; $i++)
                        <div class="card bg-light mb-3">
                            <div class="card-header py-2">
                                <strong>Service {{ $i }}</strong>
                            </div>
                            <div class="card-body py-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label>Icon Class</label>
                                            <input type="text" name="service_{{ $i }}_icon"
                                                class="form-control form-control-sm"
                                                value="{{ old('service_'.$i.'_icon', $home->{'service_'.$i.'_icon'}) }}"
                                                placeholder="e.g. flaticon-wedding-car">
                                            <small class="text-muted">Flaticon class name</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label>Title</label>
                                            <input type="text" name="service_{{ $i }}_title"
                                                class="form-control form-control-sm"
                                                value="{{ old('service_'.$i.'_title', $home->{'service_'.$i.'_title'}) }}"
                                                placeholder="Service title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label>Description</label>
                                            <input type="text" name="service_{{ $i }}_desc"
                                                class="form-control form-control-sm"
                                                value="{{ old('service_'.$i.'_desc', $home->{'service_'.$i.'_desc'}) }}"
                                                placeholder="Short description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                {{-- ===== CTA SECTION ===== --}}
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-bullhorn mr-2"></i>Call-to-Action Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" name="cta_title" id="cta_title"
                                class="form-control"
                                value="{{ old('cta_title', $home->cta_title) }}"
                                placeholder="e.g. Do You Want To Earn With Us?">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_text">Button Text</label>
                                    <input type="text" name="cta_button_text" id="cta_button_text"
                                        class="form-control"
                                        value="{{ old('cta_button_text', $home->cta_button_text) }}"
                                        placeholder="e.g. Become A Driver">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_url">Button URL</label>
                                    <input type="text" name="cta_button_url" id="cta_button_url"
                                        class="form-control"
                                        value="{{ old('cta_button_url', $home->cta_button_url) }}"
                                        placeholder="e.g. /register">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_background">CTA Background Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cta_background" id="cta_background"
                                                class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label" for="cta_background">Choose file</label>
                                        </div>
                                    </div>
                                    @if($home->cta_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($home->cta_background) }}" target="_blank">{{ basename($home->cta_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== TESTIMONIALS & BLOG HEADINGS ===== --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-purple">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-quote-left mr-2"></i>Testimonial Headings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="testimonial_subtitle">Subtitle</label>
                                    <input type="text" name="testimonial_subtitle" id="testimonial_subtitle"
                                        class="form-control"
                                        value="{{ old('testimonial_subtitle', $home->testimonial_subtitle) }}"
                                        placeholder="e.g. Testimonial">
                                </div>
                                <div class="form-group">
                                    <label for="testimonial_title">Title</label>
                                    <input type="text" name="testimonial_title" id="testimonial_title"
                                        class="form-control"
                                        value="{{ old('testimonial_title', $home->testimonial_title) }}"
                                        placeholder="e.g. Happy Clients">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-olive">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-blog mr-2"></i>Blog Headings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="blog_subtitle">Subtitle</label>
                                    <input type="text" name="blog_subtitle" id="blog_subtitle"
                                        class="form-control"
                                        value="{{ old('blog_subtitle', $home->blog_subtitle) }}"
                                        placeholder="e.g. Blog">
                                </div>
                                <div class="form-group">
                                    <label for="blog_title">Title</label>
                                    <input type="text" name="blog_title" id="blog_title"
                                        class="form-control"
                                        value="{{ old('blog_title', $home->blog_title) }}"
                                        placeholder="e.g. Recent Blog">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== COUNTERS SECTION ===== --}}
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-sort-numeric-up mr-2"></i>Counters Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @for($i = 1; $i <= 4; $i++)
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-header py-2">
                                        <strong>Counter {{ $i }}</strong>
                                    </div>
                                    <div class="card-body py-2">
                                        <div class="form-group mb-2">
                                            <label>Number</label>
                                            <input type="number" name="counter_{{ $i }}_number"
                                                class="form-control form-control-sm"
                                                value="{{ old('counter_'.$i.'_number', $home->{'counter_'.$i.'_number'}) }}"
                                                placeholder="e.g. 60">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Label</label>
                                            <input type="text" name="counter_{{ $i }}_label"
                                                class="form-control form-control-sm"
                                                value="{{ old('counter_'.$i.'_label', $home->{'counter_'.$i.'_label'}) }}"
                                                placeholder="e.g. Year Experienced">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                {{-- ===== SUBMIT ===== --}}
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('admin.homepage.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Save All Changes
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    // Update custom file input labels
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Choose file';
            this.nextElementSibling.textContent = fileName;
        });
    });
</script>
@endsection

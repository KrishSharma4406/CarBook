@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit About Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">About Page</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Please fix the errors below:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ===== HERO SECTION ===== --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-image mr-2"></i>Hero Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_title">Hero Title <span class="text-danger">*</span></label>
                                    <input type="text" name="hero_title" id="hero_title"
                                        class="form-control"
                                        value="{{ old('hero_title', $about->hero_title) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_background">Hero Background Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="hero_background" id="hero_background" class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label" for="hero_background">Choose file</label>
                                        </div>
                                    </div>
                                    @if($about->hero_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($about->hero_background) }}" target="_blank">{{ basename($about->hero_background) }}</a>
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_subtitle">Subtitle</label>
                                    <input type="text" name="about_subtitle" id="about_subtitle"
                                        class="form-control"
                                        value="{{ old('about_subtitle', $about->about_subtitle) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_title">Title</label>
                                    <input type="text" name="about_title" id="about_title"
                                        class="form-control"
                                        value="{{ old('about_title', $about->about_title) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about_description">Description</label>
                            <textarea name="about_description" id="about_description" rows="4" class="form-control">{{ old('about_description', $about->about_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_image">About Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="about_image" id="about_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="about_image">Choose file</label>
                                </div>
                            </div>
                            @if($about->about_image)
                                <small class="text-muted mt-1 d-block">
                                    Current: <a href="{{ asset($about->about_image) }}" target="_blank">{{ basename($about->about_image) }}</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ===== CTA SECTION ===== --}}
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-bullhorn mr-2"></i>Call-to-Action Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" name="cta_title" id="cta_title"
                                class="form-control"
                                value="{{ old('cta_title', $about->cta_title) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_text">Button Text</label>
                                    <input type="text" name="cta_button_text" id="cta_button_text"
                                        class="form-control"
                                        value="{{ old('cta_button_text', $about->cta_button_text) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_url">Button URL</label>
                                    <input type="text" name="cta_button_url" id="cta_button_url"
                                        class="form-control"
                                        value="{{ old('cta_button_url', $about->cta_button_url) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_background">CTA Background Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cta_background" id="cta_background" class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label" for="cta_background">Choose file</label>
                                        </div>
                                    </div>
                                    @if($about->cta_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($about->cta_background) }}" target="_blank">{{ basename($about->cta_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== TESTIMONIALS & COUNTERS ===== --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-purple">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-quote-left mr-2"></i>Testimonial Headings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="testimonial_subtitle">Subtitle</label>
                                    <input type="text" name="testimonial_subtitle" id="testimonial_subtitle"
                                        class="form-control"
                                        value="{{ old('testimonial_subtitle', $about->testimonial_subtitle) }}">
                                </div>
                                <div class="form-group">
                                    <label for="testimonial_title">Title</label>
                                    <input type="text" name="testimonial_title" id="testimonial_title"
                                        class="form-control"
                                        value="{{ old('testimonial_title', $about->testimonial_title) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-sort-numeric-up mr-2"></i>Counters</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label>Counter {{ $i }} Number <span class="badge badge-info font-weight-normal" style="font-size: 10px;">Auto</span></label>
                                            <input type="number" name="counter_{{ $i }}_number" class="form-control form-control-sm bg-light"
                                                value="{{ old('counter_'.$i.'_number', $about->{'counter_'.$i.'_number'}) }}" readonly>
                                        </div>
                                        <div class="col-md-8">
                                            <label>Counter {{ $i }} Label</label>
                                            <input type="text" name="counter_{{ $i }}_label" class="form-control form-control-sm"
                                                value="{{ old('counter_'.$i.'_label', $about->{'counter_'.$i.'_label'}) }}">
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== ACTIONS ===== --}}
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('admin.about.index') }}" class="btn btn-default"><i class="fas fa-arrow-left mr-2"></i>Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save mr-2"></i>Save Changes</button>
                    </div>
                </div>

            </form>

        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Choose file';
            this.nextElementSibling.textContent = fileName;
        });
    });
</script>
@endsection

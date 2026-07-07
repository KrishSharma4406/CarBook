@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Services Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services Page</a></li>
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

            <form action="{{ route('admin.services.update') }}" method="POST" enctype="multipart/form-data">
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
                                        value="{{ old('hero_title', $services->hero_title) }}" required>
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
                                    @if($services->hero_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($services->hero_background) }}" target="_blank">{{ basename($services->hero_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SERVICES LIST ===== --}}
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-concierge-bell mr-2"></i>Services Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="services_subtitle">Section Subtitle</label>
                                    <input type="text" name="services_subtitle" id="services_subtitle"
                                        class="form-control"
                                        value="{{ old('services_subtitle', $services->services_subtitle) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="services_title">Section Title</label>
                                    <input type="text" name="services_title" id="services_title"
                                        class="form-control"
                                        value="{{ old('services_title', $services->services_title) }}">
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
                                                <input type="text" name="service_{{ $i }}_icon" class="form-control form-control-sm"
                                                    value="{{ old('service_'.$i.'_icon', $services->{'service_'.$i.'_icon'}) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label>Title</label>
                                                <input type="text" name="service_{{ $i }}_title" class="form-control form-control-sm"
                                                    value="{{ old('service_'.$i.'_title', $services->{'service_'.$i.'_title'}) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label>Description</label>
                                                <input type="text" name="service_{{ $i }}_desc" class="form-control form-control-sm"
                                                    value="{{ old('service_'.$i.'_desc', $services->{'service_'.$i.'_desc'}) }}">
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" name="cta_title" id="cta_title"
                                class="form-control"
                                value="{{ old('cta_title', $services->cta_title) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_text">Button Text</label>
                                    <input type="text" name="cta_button_text" id="cta_button_text"
                                        class="form-control"
                                        value="{{ old('cta_button_text', $services->cta_button_text) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_url">Button URL</label>
                                    <input type="text" name="cta_button_url" id="cta_button_url"
                                        class="form-control"
                                        value="{{ old('cta_button_url', $services->cta_button_url) }}">
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
                                    @if($services->cta_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($services->cta_background) }}" target="_blank">{{ basename($services->cta_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== ACTIONS ===== --}}
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default"><i class="fas fa-arrow-left mr-2"></i>Cancel</a>
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

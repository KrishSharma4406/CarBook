@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Blog Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog Page</a></li>
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

            <form action="{{ route('admin.blog.update') }}" method="POST" enctype="multipart/form-data">
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
                                        value="{{ old('hero_title', $blog->hero_title) }}" required>
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
                                    @if($blog->hero_background)
                                        <small class="text-muted mt-1 d-block">
                                            Current: <a href="{{ asset($blog->hero_background) }}" target="_blank">{{ basename($blog->hero_background) }}</a>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== BLOG HEADINGS ===== --}}
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-heading mr-2"></i>Blog Headings</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog_subtitle">Subtitle</label>
                                    <input type="text" name="blog_subtitle" id="blog_subtitle"
                                        class="form-control"
                                        value="{{ old('blog_subtitle', $blog->blog_subtitle) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog_title">Title</label>
                                    <input type="text" name="blog_title" id="blog_title"
                                        class="form-control"
                                        value="{{ old('blog_title', $blog->blog_title) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== ACTIONS ===== --}}
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-default"><i class="fas fa-arrow-left mr-2"></i>Cancel</a>
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

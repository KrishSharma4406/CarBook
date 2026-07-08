@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Blog Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog-posts.index') }}">Blog Posts</a></li>
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

            <form action="{{ route('blog-posts.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Post Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control"
                                        value="{{ old('title', $blogPost->title) }}" required placeholder="Enter post title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" id="author"
                                        class="form-control"
                                        value="{{ old('author', $blogPost->author) }}" placeholder="Enter author name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Short Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control" required placeholder="Enter a brief summary of the post">{{ old('description', $blogPost->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="blog_content">Full Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="blog_content" rows="12"
                                class="form-control" required placeholder="Enter the full post contents">{{ old('content', $blogPost->content) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Cover Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="image">Choose image file</label>
                                </div>
                            </div>
                            @if($blogPost->image)
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Current Image:</small>
                                    <img src="{{ asset($blogPost->image) }}" 
                                         style="height:100px; width:170px; object-fit:cover; border-radius:6px; border: 1px solid #ddd;">
                                </div>
                            @endif
                            <small class="text-muted d-block mt-1">Recommended size: 800x600 pixels. Format: JPG, PNG, WEBP. Max size: 2MB.</small>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('blog-posts.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left mr-2"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Save Changes
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
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Choose image file';
            this.nextElementSibling.textContent = fileName;
        });
    });
</script>
@endsection

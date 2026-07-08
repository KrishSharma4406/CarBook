@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog Posts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">All Blog Posts</h3>
                    <div class="card-tools ml-auto">
                        <a href="{{ route('blog-posts.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Add New Post
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th style="width: 150px;">Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Short Description</th>
                                <th style="width: 180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        @if($post->image)
                                            <img src="{{ asset($post->image) }}" 
                                                 style="height:60px; width:100px; object-fit:cover; border-radius:4px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $post->title }}</strong>
                                        <br>
                                        <small class="text-muted">Slug: {{ $post->slug }}</small>
                                    </td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ Str::limit($post->description, 80) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('blog-posts.edit', $post->id) }}" 
                                               class="btn btn-info btn-sm mr-2">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('blog-posts.destroy', $post->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No blog posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($posts->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                            </small>
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>
</div>
@endsection

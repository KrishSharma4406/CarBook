@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog Page Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            @if(!$blog)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    No blog page data found. Click the button below to set up your blog page.
                </div>
                <a href="{{ route('admin.blog.edit') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus mr-2"></i>Set Up Blog Page
                </a>
            @else
                <div class="mb-3">
                    <a href="{{ route('admin.blog.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i>Edit Blog Page
                    </a>
                    <a href="{{ url('/blog') }}" target="_blank" class="btn btn-outline-info ml-2">
                        <i class="fas fa-external-link-alt mr-2"></i>View Live Page
                    </a>
                </div>

                {{-- ===== HERO SECTION ===== --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-image mr-2"></i>Hero Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th style="width:30%">Title</th>
                                        <td>{{ $blog->hero_title }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($blog->hero_background)
                                    <img src="{{ asset($blog->hero_background) }}" class="img-fluid rounded" alt="Hero BG" style="max-height: 150px;">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No background image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== BLOG HEADINGS ===== --}}
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-heading mr-2"></i>Blog Section Headings</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th style="width:30%">Subtitle</th>
                                <td>{{ $blog->blog_subtitle ?? 'Not set' }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $blog->blog_title ?? 'Not set' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            @endif

        </div>
    </section>
</div>
@endsection

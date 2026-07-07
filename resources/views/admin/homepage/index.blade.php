@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home Page Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            @if(!$home)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    No home page data found. Click the button below to set up your home page.
                </div>
                <a href="{{ route('admin.homepage.edit') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus mr-2"></i>Set Up Home Page
                </a>
            @else
                <div class="mb-3">
                    <a href="{{ route('admin.homepage.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i>Edit Home Page
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-info ml-2">
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
                                        <td>{{ $home->hero_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $home->hero_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Video URL</th>
                                        <td>{{ $home->video_url }}</td>
                                    </tr>
                                    <tr>
                                        <th>Video Text</th>
                                        <td>{{ $home->video_text }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($home->hero_background)
                                    <img src="{{ asset($home->hero_background) }}" class="img-fluid rounded" alt="Hero BG">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No background image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== ABOUT SECTION ===== --}}
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>About Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th style="width:30%">Subtitle</th>
                                        <td>{{ $home->about_subtitle ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $home->about_title ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ Str::limit($home->about_description, 200) ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($home->about_image)
                                    <img src="{{ asset($home->about_image) }}" class="img-fluid rounded" alt="About Image">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No about image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SERVICES SECTION ===== --}}
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-concierge-bell mr-2"></i>Services Section</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm mb-3">
                            <tr>
                                <th style="width:30%">Subtitle</th>
                                <td>{{ $home->services_subtitle ?? 'Not set' }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $home->services_title ?? 'Not set' }}</td>
                            </tr>
                        </table>
                        <div class="row">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <span class="{{ $home->{'service_'.$i.'_icon'} ?? 'fas fa-cog' }} fa-2x mb-2 text-primary"></span>
                                            <h6>{{ $home->{'service_'.$i.'_title'} ?? 'Service '.$i }}</h6>
                                            <small class="text-muted">{{ Str::limit($home->{'service_'.$i.'_desc'}, 60) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                {{-- ===== CTA SECTION ===== --}}
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-bullhorn mr-2"></i>Call-to-Action Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th style="width:30%">Title</th>
                                        <td>{{ $home->cta_title ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button Text</th>
                                        <td>{{ $home->cta_button_text ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button URL</th>
                                        <td>{{ $home->cta_button_url ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($home->cta_background)
                                    <img src="{{ asset($home->cta_background) }}" class="img-fluid rounded" alt="CTA BG">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No CTA background
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== TESTIMONIALS & BLOG HEADINGS ===== --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-purple card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-quote-left mr-2"></i>Testimonial Headings</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $home->testimonial_subtitle ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $home->testimonial_title ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-olive card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-blog mr-2"></i>Blog Headings</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Subtitle</th>
                                        <td>{{ $home->blog_subtitle ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $home->blog_title ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== COUNTERS SECTION ===== --}}
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-sort-numeric-up mr-2"></i>Counters Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="col-md-3">
                                    <div class="info-box bg-gradient-{{ ['info','success','warning','danger'][$i-1] }}">
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{ $home->{'counter_'.$i.'_number'} ?? 0 }}</span>
                                            <span class="info-box-text">{{ $home->{'counter_'.$i.'_label'} ?? 'Counter '.$i }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </section>
</div>
@endsection

@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">About Page Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">About Page</li>
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

            @if(!$about)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    No about page data found. Click the button below to set up your about page.
                </div>
                <a href="{{ route('admin.about.edit') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus mr-2"></i>Set Up About Page
                </a>
            @else
                <div class="mb-3">
                    <a href="{{ route('admin.about.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i>Edit About Page
                    </a>
                    <a href="{{ url('/about') }}" target="_blank" class="btn btn-outline-info ml-2">
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
                                        <td>{{ $about->hero_title }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($about->hero_background)
                                    <img src="{{ asset($about->hero_background) }}" class="img-fluid rounded" alt="Hero BG" style="max-height: 150px;">
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
                                        <td>{{ $about->about_subtitle ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $about->about_title ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $about->about_description ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($about->about_image)
                                    <img src="{{ asset($about->about_image) }}" class="img-fluid rounded" alt="About Image" style="max-height: 150px;">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No about image
                                    </div>
                                @endif
                            </div>
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
                                        <td>{{ $about->cta_title ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button Text</th>
                                        <td>{{ $about->cta_button_text ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button URL</th>
                                        <td>{{ $about->cta_button_url ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($about->cta_background)
                                    <img src="{{ asset($about->cta_background) }}" class="img-fluid rounded" alt="CTA BG" style="max-height: 150px;">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No CTA background
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== TESTIMONIALS & COUNTERS ===== --}}
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
                                        <td>{{ $about->testimonial_subtitle ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $about->testimonial_title ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-sort-numeric-up mr-2"></i>Counters</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Counter 1</th>
                                        <td>{{ $about->counter_1_number }} - {{ $about->counter_1_label }}</td>
                                    </tr>
                                    <tr>
                                        <th>Counter 2</th>
                                        <td>{{ $about->counter_2_number }} - {{ $about->counter_2_label }}</td>
                                    </tr>
                                    <tr>
                                        <th>Counter 3</th>
                                        <td>{{ $about->counter_3_number }} - {{ $about->counter_3_label }}</td>
                                    </tr>
                                    <tr>
                                        <th>Counter 4</th>
                                        <td>{{ $about->counter_4_number }} - {{ $about->counter_4_label }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </section>
</div>
@endsection

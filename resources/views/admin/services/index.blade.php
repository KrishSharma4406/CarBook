@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services Page Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Services Page</li>
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

            @if(!$services)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    No services page data found. Click the button below to set up your services page.
                </div>
                <a href="{{ route('admin.services.edit') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus mr-2"></i>Set Up Services Page
                </a>
            @else
                <div class="mb-3">
                    <a href="{{ route('admin.services.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i>Edit Services Page
                    </a>
                    <a href="{{ url('/service') }}" target="_blank" class="btn btn-outline-info ml-2">
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
                                        <td>{{ $services->hero_title }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($services->hero_background)
                                    <img src="{{ asset($services->hero_background) }}" class="img-fluid rounded" alt="Hero BG" style="max-height: 150px;">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No background image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SERVICES LIST ===== --}}
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-concierge-bell mr-2"></i>Services Section</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm mb-3">
                            <tr>
                                <th style="width:30%">Subtitle</th>
                                <td>{{ $services->services_subtitle ?? 'Not set' }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $services->services_title ?? 'Not set' }}</td>
                            </tr>
                        </table>
                        <div class="row">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <span class="{{ $services->{'service_'.$i.'_icon'} ?? 'fas fa-cog' }} fa-2x mb-2 text-primary"></span>
                                            <h6>{{ $services->{'service_'.$i.'_title'} ?? 'Service '.$i }}</h6>
                                            <small class="text-muted">{{ Str::limit($services->{'service_'.$i.'_desc'}, 100) }}</small>
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
                                        <td>{{ $services->cta_title ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button Text</th>
                                        <td>{{ $services->cta_button_text ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button URL</th>
                                        <td>{{ $services->cta_button_url ?? 'Not set' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                @if($services->cta_background)
                                    <img src="{{ asset($services->cta_background) }}" class="img-fluid rounded" alt="CTA BG" style="max-height: 150px;">
                                @else
                                    <div class="text-muted text-center p-4 bg-light rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>No CTA background
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </section>
</div>
@endsection

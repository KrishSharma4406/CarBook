@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    {{-- Content Header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Driver Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Driver Applications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <section class="content">
        <div class="container-fluid">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            {{-- Stat Cards Row --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $metrics['total'] }}</h3>
                            <p>Total Applications</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <a href="{{ route('driver-applications.index') }}" class="small-box-footer">
                            View All <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $metrics['pending'] }}</h3>
                            <p>Pending Review</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="{{ route('driver-applications.index', ['status' => 'pending']) }}" class="small-box-footer">
                            Filter Pending <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $metrics['contacted'] }}</h3>
                            <p>Contacted Drivers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <a href="{{ route('driver-applications.index', ['status' => 'contacted']) }}" class="small-box-footer">
                            Filter Contacted <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $metrics['approved'] }}</h3>
                            <p>Approved Drivers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <a href="{{ route('driver-applications.index', ['status' => 'approved']) }}" class="small-box-footer">
                            Filter Approved <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Filter and Search Card --}}
            <div class="card card-outline card-primary">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center p-3">
                    <div class="btn-group mb-2 mb-md-0" role="group">
                        <a href="{{ route('driver-applications.index') }}" 
                           class="btn btn-sm {{ !request('status') || request('status') == 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">
                            All ({{ $metrics['total'] }})
                        </a>
                        <a href="{{ route('driver-applications.index', ['status' => 'pending']) }}" 
                           class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning text-dark font-weight-bold' : 'btn-outline-secondary' }}">
                            Pending ({{ $metrics['pending'] }})
                        </a>
                        <a href="{{ route('driver-applications.index', ['status' => 'contacted']) }}" 
                           class="btn btn-sm {{ request('status') == 'contacted' ? 'btn-info text-white' : 'btn-outline-secondary' }}">
                            Contacted ({{ $metrics['contacted'] }})
                        </a>
                        <a href="{{ route('driver-applications.index', ['status' => 'approved']) }}" 
                           class="btn btn-sm {{ request('status') == 'approved' ? 'btn-success text-white' : 'btn-outline-secondary' }}">
                            Approved ({{ $metrics['approved'] }})
                        </a>
                        <a href="{{ route('driver-applications.index', ['status' => 'rejected']) }}" 
                           class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-danger text-white' : 'btn-outline-secondary' }}">
                            Rejected ({{ $metrics['rejected'] }})
                        </a>
                    </div>

                    <form action="{{ route('driver-applications.index') }}" method="GET" class="form-inline">
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search name, phone, email, plate..." 
                                   value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('driver-applications.index', request('status') ? ['status' => request('status')] : []) }}" 
                                       class="btn btn-default" title="Clear Search">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th>Applicant</th>
                                <th>Contact Details</th>
                                <th>City</th>
                                <th>Vehicle & Experience</th>
                                <th class="text-center">Status</th>
                                <th>Applied At</th>
                                <th style="width: 150px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $app->id }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $app->name }}</div>
                                        @if($app->user)
                                            <span class="badge badge-light border">
                                                <i class="fas fa-user-check text-success mr-1"></i> Registered User
                                            </span>
                                        @else
                                            <span class="badge badge-light border text-muted">Guest</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="tel:{{ $app->phone }}" class="text-dark font-weight-bold">
                                                <i class="fas fa-phone-alt text-success mr-1"></i> {{ $app->phone }}
                                            </a>
                                        </div>
                                        <div>
                                            <a href="mailto:{{ $app->email }}" class="text-muted small">
                                                <i class="fas fa-envelope mr-1"></i> {{ $app->email }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $app->city }}</td>
                                    <td>
                                        <div><strong>{{ $app->vehicle_make_model }}</strong> ({{ $app->vehicle_type }})</div>
                                        <div class="small text-muted">Plate: <span class="badge badge-secondary">{{ $app->vehicle_number }}</span> | {{ $app->experience_years }} yrs exp</div>
                                    </td>
                                    <td class="text-center">
                                        @if($app->status == 'pending')
                                            <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i> Pending</span>
                                        @elseif($app->status == 'contacted')
                                            <span class="badge badge-info px-2 py-1"><i class="fas fa-phone mr-1"></i> Contacted</span>
                                        @elseif($app->status == 'approved')
                                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Approved</span>
                                        @elseif($app->status == 'rejected')
                                            <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted d-block">{{ $app->created_at->format('M d, Y') }}</small>
                                        <small class="text-muted">{{ $app->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('driver-applications.show', $app->id) }}" 
                                               class="btn btn-sm btn-info" title="View Details & Contact">
                                                <i class="fas fa-eye mr-1"></i> View
                                            </a>
                                            <form action="{{ route('driver-applications.destroy', $app->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete application #{{ $app->id }} from {{ $app->name }}?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ml-1" title="Delete Application">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-id-card-alt text-muted fa-3x mb-3"></i>
                                        <p class="text-muted font-weight-bold mb-0">No driver applications found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($applications->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <small class="text-muted mb-2 mb-md-0">
                                Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} applications
                            </small>
                            {{ $applications->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>
</div>
@endsection

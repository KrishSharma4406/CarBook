@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    {{-- Content Header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Driver Application #{{ $driverApplication->id }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver-applications.index') }}">Driver Applications</a></li>
                        <li class="breadcrumb-item active">Application #{{ $driverApplication->id }}</li>
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

            {{-- Quick Contact Action Bar --}}
            <div class="card bg-light border">
                <div class="card-body p-3 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2 mb-md-0">
                        <div class="mr-3">
                            <span class="badge badge-pill badge-primary p-2" style="font-size: 16px;">
                                <i class="fas fa-id-card"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $driverApplication->name }}</h5>
                            <span class="text-muted small">Applied on {{ $driverApplication->created_at->format('M d, Y h:i A') }} ({{ $driverApplication->created_at->diffForHumans() }})</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex flex-wrap gap-2">
                        {{-- WhatsApp Button --}}
                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Hello ' . $driverApplication->name . ', this is CarBook Admin regarding your driver application #' . $driverApplication->id . '. We would like to discuss further details with you.') }}" 
                           target="_blank" 
                           class="btn btn-success mr-2 mb-1" 
                           title="Chat on WhatsApp">
                            <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                        </a>

                        {{-- Phone Call Button --}}
                        <a href="tel:{{ $driverApplication->phone }}" 
                           class="btn btn-primary mr-2 mb-1" 
                           title="Direct Phone Call">
                            <i class="fas fa-phone-alt mr-1"></i> Call: {{ $driverApplication->phone }}
                        </a>

                        {{-- Email Button --}}
                        <a href="mailto:{{ $driverApplication->email }}?subject={{ urlencode('CarBook - Driver Application Status #' . $driverApplication->id) }}&body={{ urlencode('Dear ' . $driverApplication->name . ",\n\nThank you for applying to become a driver partner at CarBook.\n\n") }}" 
                           class="btn btn-secondary mr-2 mb-1" 
                           title="Send Email">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </a>

                        <a href="{{ route('driver-applications.index') }}" class="btn btn-default mb-1">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Left Column: Applicant Information --}}
                <div class="col-lg-8">

                    {{-- 1. Personal & Contact Card --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-user mr-2 text-primary"></i> Personal & Contact Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Full Name:</div>
                                <div class="col-sm-8 font-weight-bold">{{ $driverApplication->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Email:</div>
                                <div class="col-sm-8">
                                    <a href="mailto:{{ $driverApplication->email }}">{{ $driverApplication->email }}</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Phone Number:</div>
                                <div class="col-sm-8 font-weight-bold text-primary">
                                    <a href="tel:{{ $driverApplication->phone }}">{{ $driverApplication->phone }}</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Date of Birth:</div>
                                <div class="col-sm-8">
                                    {{ $driverApplication->dob ? $driverApplication->dob->format('M d, Y') . ' (' . $driverApplication->dob->age . ' years old)' : 'Not specified' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">City / State:</div>
                                <div class="col-sm-8">
                                    {{ $driverApplication->city }}{{ $driverApplication->state ? ', ' . $driverApplication->state : '' }}{{ $driverApplication->postal_code ? ' - ' . $driverApplication->postal_code : '' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Residential Address:</div>
                                <div class="col-sm-8">{{ $driverApplication->address ?? 'Not provided' }}</div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-sm-4 text-muted">CarBook Account:</div>
                                <div class="col-sm-8">
                                    @if($driverApplication->user)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle mr-1"></i> Registered User (ID: #{{ $driverApplication->user->id }})
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">Guest Applicant</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Driving License & Experience --}}
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-id-badge mr-2 text-info"></i> Driving Credentials
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">License Number:</div>
                                <div class="col-sm-8 font-weight-bold" style="font-size: 16px; letter-spacing: 0.5px;">
                                    <code>{{ $driverApplication->license_number }}</code>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">License Expiry:</div>
                                <div class="col-sm-8">
                                    @if($driverApplication->license_expiry)
                                        {{ $driverApplication->license_expiry->format('M d, Y') }}
                                        @if($driverApplication->license_expiry->isPast())
                                            <span class="badge badge-danger ml-2">Expired</span>
                                        @else
                                            <span class="badge badge-success ml-2">Valid</span>
                                        @endif
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 text-muted">Driving Experience:</div>
                                <div class="col-sm-8">
                                    <span class="badge badge-info p-2 font-weight-bold" style="font-size: 13px;">
                                        {{ $driverApplication->experience_years }} {{ Str::plural('Year', $driverApplication->experience_years) }} Experience
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 text-muted">Uploaded License:</div>
                                <div class="col-sm-8">
                                    @if($driverApplication->license_document && file_exists(public_path($driverApplication->license_document)))
                                        @php
                                            $ext = strtolower(pathinfo($driverApplication->license_document, PATHINFO_EXTENSION));
                                        @endphp
                                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                            <div class="mb-2">
                                                <a href="{{ asset($driverApplication->license_document) }}" target="_blank">
                                                    <img src="{{ asset($driverApplication->license_document) }}" 
                                                         alt="Driving License" 
                                                         class="img-thumbnail rounded" 
                                                         style="max-height: 220px; object-fit: contain;">
                                                </a>
                                            </div>
                                        @endif
                                        <a href="{{ asset($driverApplication->license_document) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-external-link-alt mr-1"></i> Open Document ({{ strtoupper($ext) }})
                                        </a>
                                    @else
                                        <span class="text-muted font-italic">No document uploaded by applicant.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Vehicle Information --}}
                    <div class="card card-success card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-car mr-2 text-success"></i> Vehicle Details
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Vehicle Type:</div>
                                <div class="col-sm-8 font-weight-bold">{{ $driverApplication->vehicle_type }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Make & Model:</div>
                                <div class="col-sm-8 font-weight-bold text-dark">{{ $driverApplication->vehicle_make_model }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 text-muted">Registration Number:</div>
                                <div class="col-sm-8">
                                    <span class="badge badge-dark px-3 py-1 font-weight-bold" style="font-size: 14px; letter-spacing: 1px;">
                                        {{ $driverApplication->vehicle_number }}
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-sm-4 text-muted">Manufacturing Year:</div>
                                <div class="col-sm-8">{{ $driverApplication->vehicle_year ?? 'Not specified' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Applicant Message / Notes --}}
                    @if($driverApplication->message)
                    <div class="card card-outline card-secondary mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-comment-dots mr-2"></i> Message From Applicant
                            </h3>
                        </div>
                        <div class="card-body bg-light">
                            <p class="mb-0" style="white-space: pre-wrap; font-size: 15px;">{{ $driverApplication->message }}</p>
                        </div>
                    </div>
                    @endif

                </div>

                {{-- Right Column: Status & Admin Management --}}
                <div class="col-lg-4">

                    {{-- Status & Follow-up Notes Card --}}
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-tasks mr-2 text-warning"></i> Application Status & Follow-Up
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('driver-applications.update', $driverApplication->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Current Application Status</label>
                                    <select name="status" id="status" class="form-control form-control-lg">
                                        <option value="pending" {{ $driverApplication->status == 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending Review
                                        </option>
                                        <option value="contacted" {{ $driverApplication->status == 'contacted' ? 'selected' : '' }}>
                                            📞 Contacted (Called / WhatsApp)
                                        </option>
                                        <option value="approved" {{ $driverApplication->status == 'approved' ? 'selected' : '' }}>
                                            ✅ Approved as Driver
                                        </option>
                                        <option value="rejected" {{ $driverApplication->status == 'rejected' ? 'selected' : '' }}>
                                            ❌ Rejected / Ineligible
                                        </option>
                                    </select>
                                </div>

                                @if($driverApplication->contacted_at)
                                    <div class="alert alert-info py-2 px-3 small mb-3">
                                        <i class="fas fa-history mr-1"></i> First contacted: {{ $driverApplication->contacted_at->format('M d, Y h:i A') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="admin_notes" class="font-weight-bold">Admin Follow-Up Notes</label>
                                    <textarea name="admin_notes" id="admin_notes" rows="6" 
                                              class="form-control" 
                                              placeholder="Write notes about your conversation with the driver (e.g. called on 12th, verified documents, agreed on commission rate, scheduled vehicle check)...">{{ old('admin_notes', $driverApplication->admin_notes) }}</textarea>
                                    <small class="text-muted">These notes are strictly internal and visible only to administrators.</small>
                                </div>

                                <button type="submit" class="btn btn-warning btn-block font-weight-bold py-2">
                                    <i class="fas fa-save mr-1"></i> Save Changes & Notes
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Admin Actions Card --}}
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold text-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Danger Zone
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-3">Deleting this application will permanently remove all driver registration details and uploaded license documents.</p>
                            <form action="{{ route('driver-applications.destroy', $driverApplication->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to permanently delete this driver application? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-block">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete Application
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>
@endsection

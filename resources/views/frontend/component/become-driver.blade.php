{{-- Hero Section --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Become A Driver <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-3 bread">Drive With CarBook</h1>
                <p class="text-white lead" style="max-width: 650px;">Turn your driving skills into rewarding earnings. Join our verified driver fleet, enjoy flexible hours, and grow with us.</p>
            </div>
        </div>
    </div>
</section>

{{-- Main Section --}}
<section class="ftco-section become-driver-section bg-light">
    <div class="container">
        
        {{-- Value Proposition Row --}}
        <div class="row mb-5 pb-3">
            <div class="col-md-3 mb-4">
                <div class="driver-benefit-box">
                    <div class="benefit-icon">
                        <i class="ion-ios-time"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Flexible Schedule</h5>
                    <p class="text-muted small mb-0">You choose when and where you drive. Be your own boss on your own terms.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="driver-benefit-box">
                    <div class="benefit-icon">
                        <i class="ion-ios-cash"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Attractive Earnings</h5>
                    <p class="text-muted small mb-0">Competitive payouts, bonuses for peak hours, and timely direct bank transfers.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="driver-benefit-box">
                    <div class="benefit-icon">
                        <i class="ion-ios-shield"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Safety & Insurance</h5>
                    <p class="text-muted small mb-0">Round-the-clock roadside assistance, trip coverage, and emergency support.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="driver-benefit-box">
                    <div class="benefit-icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Dedicated Admin Care</h5>
                    <p class="text-muted small mb-0">Our local management team personally guides you through fast onboarding.</p>
                </div>
            </div>
        </div>

        {{-- Form Container --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="driver-card">

                    {{-- Section Header --}}
                    <div class="section-header text-center">
                        <span class="subheading text-uppercase text-primary font-weight-bold" style="letter-spacing: 1px; font-size: 13px;">Partner Application</span>
                        <h2 class="section-title">Driver Registration Application</h2>
                        <p class="text-muted mb-0">Please fill out all the details below. Our admin team will verify your credentials and reach out to you directly for onboarding.</p>
                    </div>

                    {{-- Existing Application Notice (for logged-in users) --}}
                    @if(isset($existingApplication))
                        <div class="existing-app-banner d-flex align-items-center justify-content-between flex-wrap">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <i class="ion-ios-information-circle text-primary mr-3" style="font-size: 28px;"></i>
                                <div>
                                    <strong>Previous Application Found:</strong>
                                    <span class="text-muted ml-2">Applied on {{ $existingApplication->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div>
                                Status: 
                                @if($existingApplication->status == 'pending')
                                    <span class="badge badge-warning py-2 px-3">Under Review (Pending)</span>
                                @elseif($existingApplication->status == 'contacted')
                                    <span class="badge badge-info py-2 px-3">Contacted by Admin</span>
                                @elseif($existingApplication->status == 'approved')
                                    <span class="badge badge-success py-2 px-3">Approved</span>
                                @elseif($existingApplication->status == 'rejected')
                                    <span class="badge badge-danger py-2 px-3">Declined</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Flash Errors --}}
                    @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="ion-ios-alert mr-2"></i>
                            <strong>Please check the form for errors:</strong>
                            <ul class="mb-0 mt-2 pl-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    {{-- Application Form --}}
                    <form action="{{ route('become.driver.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Step 1: Personal Details --}}
                        <div class="form-section-title">
                            <i class="ion-ios-person"></i> 1. Personal & Contact Information
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span class="required">*</span></label>
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           placeholder="e.g. John Doe"
                                           value="{{ old('name', $user->name ?? '') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           placeholder="e.g. driver@example.com"
                                           value="{{ old('email', $user->email ?? '') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone / WhatsApp Number <span class="required">*</span></label>
                                    <input type="text" name="phone" id="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           placeholder="e.g. +91 98765 43210"
                                           value="{{ old('phone', $user->phone ?? '') }}" required>
                                    <small class="text-muted">Admin will use this number to contact you via call or WhatsApp.</small>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" 
                                           class="form-control @error('dob') is-invalid @enderror" 
                                           value="{{ old('dob') }}">
                                    <small class="text-muted">Must be at least 18 years of age.</small>
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City / Town <span class="required">*</span></label>
                                    <input type="text" name="city" id="city" 
                                           class="form-control @error('city') is-invalid @enderror" 
                                           placeholder="e.g. Mumbai, Delhi, Bengaluru"
                                           value="{{ old('city') }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State / Province</label>
                                    <input type="text" name="state" id="state" 
                                           class="form-control @error('state') is-invalid @enderror" 
                                           placeholder="e.g. Maharashtra"
                                           value="{{ old('state') }}">
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postal_code">Postal / Pin Code</label>
                                    <input type="text" name="postal_code" id="postal_code" 
                                           class="form-control @error('postal_code') is-invalid @enderror" 
                                           placeholder="e.g. 400001"
                                           value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Residential Address</label>
                            <textarea name="address" id="address" rows="2" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      placeholder="Street address, apartment or landmark">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Step 2: License & Driving Credentials --}}
                        <div class="form-section-title">
                            <i class="ion-ios-card"></i> 2. Driving License & Experience
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_number">Driving License Number <span class="required">*</span></label>
                                    <input type="text" name="license_number" id="license_number" 
                                           class="form-control @error('license_number') is-invalid @enderror" 
                                           placeholder="e.g. DL-0420110012345"
                                           value="{{ old('license_number') }}" required>
                                    @error('license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_expiry">License Expiry Date</label>
                                    <input type="date" name="license_expiry" id="license_expiry" 
                                           class="form-control @error('license_expiry') is-invalid @enderror" 
                                           value="{{ old('license_expiry') }}">
                                    @error('license_expiry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="experience_years">Driving Experience (Years) <span class="required">*</span></label>
                                    <input type="number" name="experience_years" id="experience_years" min="0" max="50"
                                           class="form-control @error('experience_years') is-invalid @enderror" 
                                           placeholder="e.g. 3"
                                           value="{{ old('experience_years', 2) }}" required>
                                    @error('experience_years')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Driving License Document / Photo (Optional)</label>
                            <label class="custom-file-upload d-block" for="license_document">
                                <i class="ion-ios-cloud-upload text-primary" style="font-size: 32px;"></i>
                                <p class="mb-1 font-weight-bold">Click here to upload your License (Front / Copy)</p>
                                <span id="file-name-display" class="text-muted small">Supports JPG, PNG, or PDF up to 5MB</span>
                                <input type="file" name="license_document" id="license_document" 
                                       class="d-none" accept=".jpg,.jpeg,.png,.pdf">
                            </label>
                            @error('license_document')
                                <small class="text-danger font-weight-bold d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Step 3: Vehicle Details --}}
                        <div class="form-section-title">
                            <i class="ion-ios-car"></i> 3. Vehicle Information
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">Vehicle Type / Category <span class="required">*</span></label>
                                    <select name="vehicle_type" id="vehicle_type" 
                                            class="form-control @error('vehicle_type') is-invalid @enderror" required>
                                        <option value="Sedan" {{ old('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan (e.g. Honda City, Dzire, Verna)</option>
                                        <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV (e.g. Creta, Brezza, Harrier)</option>
                                        <option value="Hatchback" {{ old('vehicle_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback (e.g. Swift, i20, Baleno)</option>
                                        <option value="MUV / 7 Seater" {{ old('vehicle_type') == 'MUV / 7 Seater' ? 'selected' : '' }}>MUV / 7-Seater (e.g. Innova, Ertiga)</option>
                                        <option value="Luxury" {{ old('vehicle_type') == 'Luxury' ? 'selected' : '' }}>Luxury (e.g. Mercedes, BMW, Audi)</option>
                                        <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van / Commercial</option>
                                    </select>
                                    @error('vehicle_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_make_model">Vehicle Make & Model <span class="required">*</span></label>
                                    <input type="text" name="vehicle_make_model" id="vehicle_make_model" 
                                           class="form-control @error('vehicle_make_model') is-invalid @enderror" 
                                           placeholder="e.g. Toyota Innova Crysta"
                                           value="{{ old('vehicle_make_model') }}" required>
                                    @error('vehicle_make_model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_number">Vehicle Registration Number (Plate) <span class="required">*</span></label>
                                    <input type="text" name="vehicle_number" id="vehicle_number" 
                                           class="form-control @error('vehicle_number') is-invalid @enderror" 
                                           placeholder="e.g. MH 01 AB 1234"
                                           value="{{ old('vehicle_number') }}" required>
                                    @error('vehicle_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_year">Manufacturing Year</label>
                                    <input type="text" name="vehicle_year" id="vehicle_year" 
                                           class="form-control @error('vehicle_year') is-invalid @enderror" 
                                           placeholder="e.g. 2022"
                                           value="{{ old('vehicle_year') }}">
                                    @error('vehicle_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Step 4: Notes & Agreement --}}
                        <div class="form-section-title">
                            <i class="ion-ios-paper"></i> 4. Additional Message & Terms
                        </div>

                        <div class="form-group">
                            <label for="message">About Yourself / Preferred Working Hours or Areas</label>
                            <textarea name="message" id="message" rows="3" 
                                      class="form-control @error('message') is-invalid @enderror" 
                                      placeholder="Tell us a little about yourself, previous chauffeur experience, or special routes you prefer...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input @error('agree_terms') is-invalid @enderror" 
                                       id="agree_terms" name="agree_terms" value="1" 
                                       {{ old('agree_terms') ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="agree_terms" style="cursor: pointer; font-size: 14px;">
                                    I certify that all the information provided is accurate and authentic. I authorize the CarBook team to contact me via phone call, SMS, or WhatsApp regarding this driver application.
                                </label>
                                @error('agree_terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center pt-3">
                            <button type="submit" class="btn-submit-driver">
                                <i class="ion-ios-send mr-2"></i> Submit Driver Application
                            </button>
                            <p class="text-muted small mt-3 mb-0">
                                <i class="ion-ios-lock mr-1"></i> Your information is kept strictly confidential and used solely for driver onboarding.
                            </p>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>

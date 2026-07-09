@extends('frontend.layout.app')

@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
        <div class="overlay"></div>

        <div class="container">

            <div class="row no-gutters slider-text align-items-end justify-content-center">

                <div class="col-md-9 text-center mb-5">

                    <h1 class="mb-2 bread text-white">
                        My Profile
                    </h1>

                </div>

            </div>

        </div>

    </section>

    <section class="ftco-section bg-light">

        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status') == 'profile-updated')
                <div class="alert alert-success">
                    Profile updated successfully.
                </div>
            @endif

            <!-- ================= PROFILE ================= -->

            <div class="card shadow mb-5">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        <i class="fa fa-user mr-2"></i>
                        My Profile
                    </h4>

                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="row">

                            <div class="col-md-12 text-center mb-4">

                                <img src="{{ asset('uploads/profileimages/' . $user->profile_image) }}" class="rounded-circle shadow"
                                    width="140" height="140" style="object-fit:cover;">

                                <div class="mt-3">
                                    <label class="font-weight-bold">Profile Image</label>

                                    <input type="file" name="profile_image" class="form-control mt-2" accept="image/*">

                                    @error('profile_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Name</label>

                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Contact Number</label>

                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Member Since</label>

                                <input type="text" class="form-control" value="{{ $user->created_at->format('d M Y') }}"
                                    readonly>

                            </div>

                        </div>

                        @can('profile.edit')
                            <button class="btn btn-primary">
                                Update Profile
                            </button>
                        @endcan

                    </form>

                </div>

            </div>

            <!-- ================= MY CARS ================= -->

            <div class="card shadow">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                    <h4 class="mb-0 text-white">
                        <i class="fa fa-car mr-2"></i>
                        My Cars
                    </h4>

                    @can('cars.create')
                        <a href="{{ route('car.edit') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                            Add Car
                        </a>
                    @endcan

                </div>

                <div class="card-body">

                    @if($user->cars->count())

                        <div class="row">

                            @foreach($user->cars as $car)

                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                                    <div class="card shadow-sm h-100 border-0">

                                        <img src="{{ asset('uploads/cars/' . $car->image) }}" class="card-img-top"
                                            style="height:180px;object-fit:cover;">

                                        <div class="card-body">

                                            <h5 class="font-weight-bold">

                                                {{ $car->brand }}

                                                {{ $car->model }}

                                            </h5>

                                            <p class="mb-1">
                                                <strong>Name:</strong>
                                                {{ $car->car_name }}
                                            </p>

                                            <p class="mb-1">
                                                <strong>Registration:</strong>
                                                {{ $car->registration_number }}
                                            </p>

                                            <p class="mb-1">
                                                <strong>Fuel:</strong>
                                                {{ $car->fuel_type }}
                                            </p>

                                            <p class="mb-3">
                                                <strong>₹{{ $car->rent_per_day }}</strong>/day
                                            </p>

                                        </div>

                                        <div class="card-footer bg-white border-0">

                                            <div class="row">

                                                <div class="col-6">

                                                    @can('cars.edit')
                                                        <a href="{{ route('car.edit.single', $car->id) }}" class="btn btn-primary btn-block">

                                                            <i class="fa fa-edit"></i>

                                                            Edit

                                                        </a>
                                                    @endcan

                                                </div>

                                                <div class="col-6">

                                                    @can('cars.delete')

                                                        <form action="{{ route('car.destroy', $car->id) }}" method="POST"
                                                            onsubmit="return confirm('Delete this car?')">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger btn-block">

                                                                <i class="fa fa-trash"></i>

                                                                Delete

                                                            </button>

                                                        </form>
                                                    @endcan

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="fa fa-car fa-4x text-muted mb-3"></i>

                            <h4>No Cars Added</h4>

                            <p>Add your first car to start offering rides.</p>

                            @can('cars.create')
                                <a href="{{ route('car.edit') }}" class="btn btn-primary">

                                    Add Car

                                </a>
                            @endcan

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

    </div>

@endsection
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

        <div class="row align-items-start">

            <!-- Profile -->
            <div class="col-md-8">

                <div class="col-md-4">

                    <div class="card-header bg-primary text-white">

                        <h4 class="mb-0">

                            <i class="fa fa-user mr-2"></i>

                            My Profile

                        </h4>

                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('profile.update') }}">

                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name',$user->name) }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email',$user->email) }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone',$user->phone) }}">
                            </div>

                            <div class="mb-3">
                                <label>Member Since</label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $user->created_at->format('d M Y') }}"
                                    readonly>
                            </div>

                            <button class="btn btn-primary">
                                Update Profile
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Car -->
            <div class="col-md-4">

                <div class="card shadow">

                    <div class="card-header bg-dark text-white">

                        <h4 class="mb-0 text-white">

                            <i class="fa fa-car mr-2"></i>

                            My Car

                        </h4>

                    </div>

                    <div class="card-body">

                        @if($cars)

                        @if($cars->image)
                        <img src="{{ asset('uploads/cars/'.$cars->image) }}"
                            class="class=" img-fluid rounded shadow"

                            style="height:220px;
width:100%;
object-fit:cover;">
                        @endif

                        <h5>{{ $cars->car_name }}</h5>

                        <p><strong>Brand:</strong> {{ $cars->brand }}</p>

                        <p><strong>Model:</strong> {{ $cars->model }}</p>

                        <p><strong>Registration:</strong> {{ $cars->registration_number }}</p>

                        <p><strong>Rent/Day:</strong> ₹{{ $cars->rent_per_day }}</p>

                        <a href="{{ route('car.edit') }}"
                            class="btn btn-primary btn-block py-3">

                            Edit Car

                        </a>

                        @else

                        <p>No car added yet.</p>

                        <a href="{{ route('car.edit') }}"
                            class="btn btn-primary w-100">

                            Add Car

                        </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

</div>

@endsection
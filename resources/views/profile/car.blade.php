@extends('frontend.layout.app')

@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 text-center mb-5">
                <h1 class="mb-2 bread">Add Your Car</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Car Details <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fa fa-car"></i> Car Information
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('car.save') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Car Name</label>
                                    <input type="text" name="car_name" class="form-control"
                                        value="{{ old('car_name',$car->car_name ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand',$car->brand ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Model</label>
                                    <input type="text" name="model" class="form-control"
                                        value="{{ old('model',$car->model ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Registration No.</label>
                                    <input type="text" name="registration_number" class="form-control"
                                        value="{{ old('registration_number',$car->registration_number ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Manufacturing Year</label>
                                    <input type="number" name="manufacturing_year" class="form-control"
                                        value="{{ old('manufacturing_year',$car->manufacturing_year ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control"
                                        value="{{ old('color',$car->color ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Fuel Type</label>

                                    <select name="fuel_type" class="form-control">
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="CNG">CNG</option>
                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Transmission</label>

                                    <select name="transmission" class="form-control">
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Rent Per Day (₹)</label>
                                    <input type="number" name="rent_per_day" class="form-control"
                                        value="{{ old('rent_per_day',$car->rent_per_day ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Car Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                @if(isset($car) && $car->image)
                                <div class="col-12 text-center mb-3">
                                    <img src="{{ asset('uploads/cars/'.$car->image) }}"
                                        class="img-fluid rounded shadow"
                                        style="max-height:220px;">
                                </div>
                                @endif

                                <div class="col-12 mb-3">

                                    <label>Description</label>

                                    <textarea name="description"
                                        rows="5"
                                        class="form-control">{{ old('description',$car->description ?? '') }}</textarea>

                                </div>

                            </div>

                            <div class="text-center">

                                <button class="btn btn-primary px-5">

                                    <i class="fa fa-save"></i>

                                    Save Car

                                </button>

                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-secondary px-5">

                                    Back

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
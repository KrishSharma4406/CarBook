<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 pb-5">
                <h1 class="mb-3 bread">Offer a Ride</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">

    <div class="container">

        @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @endif

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">

                        <h4>Offer Ride</h4>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('offer.ride.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label>Pickup Location</label>
                                <input type="text"
                                    name="pickup_location"
                                    class="form-control"
                                    value="{{ old('pickup_location') }}">
                                @error('pickup_location')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Destination</label>
                                <input type="text"
                                    name="destination"
                                    class="form-control"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date"
                                            name="travel_date"
                                            class="form-control"
                                            value="{{ old('travel_date') }}">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Time</label>
                                        <input type="time"
                                            name="travel_time"
                                            class="form-control"
                                            value="{{ old('travel_time') }}">
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Available Seats</label>
                                        <input type="number"
                                            name="available_seats"
                                            class="form-control"
                                            value="{{ old('available_seats') }}">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Fare (₹)</label>
                                        <input type="number"
                                            name="fare"
                                            class="form-control"
                                            value="{{ old('fare') }}">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label>Select Your Car</label>

                                <select name="car_id" class="form-control" required>

                                    <option value="">Choose a Car</option>

                                    @foreach(auth()->user()->cars as $car)

                                    <option value="{{ $car->id }}">

                                        {{ $car->brand }}
                                        {{ $car->model }}
                                        -
                                        {{ $car->registration_number }}

                                    </option>

                                    @endforeach

                                </select>

                                @error('car_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Description</label>

                                <textarea
                                    name="description"
                                    rows="4"
                                    class="form-control">{{ old('description') }}</textarea>

                            </div>

                            <button class="btn btn-success btn-block">

                                Offer Ride

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
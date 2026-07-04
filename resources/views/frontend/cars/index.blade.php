@extends('frontend.layout.app')
@section('content')

@can('cars.view')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Cars</h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

            @endif

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">All User Cars</h3>

                    @can('cars.create')
                    <a href="{{ route('car.edit') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Car
                    </a>
                    @endcan

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Image</th>

                                <th>Owner</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Car</th>

                                <th>Brand</th>

                                <th>Model</th>

                                <th>Rent/Day</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($cars as $car)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    @if($car->image)

                                    <img src="{{ asset('uploads/cars/'.$car->image) }}"
                                        width="100"
                                        height="70"
                                        style="object-fit:cover">

                                    @endif

                                </td>

                                <td>{{ $car->user->name }}</td>

                                <td>{{ $car->user->email }}</td>

                                <td>{{ $car->user->phone }}</td>

                                <td>{{ $car->car_name }}</td>

                                <td>{{ $car->brand }}</td>

                                <td>{{ $car->model }}</td>

                                <td>₹{{ number_format($car->rent_per_day) }}</td>

                                <td>

                                    @can('cars.view')
                                    <a href="{{ route('admin.cars.show', $car->id) }}"
                                        class="btn btn-info btn-sm">
                                        View
                                    </a>
                                    @endcan

                                    @can('cars.delete')
                                    <form action="{{ route('admin.cars.destroy', $car->id) }}"
                                        method="POST"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this car?')">
                                            Delete
                                        </button>

                                    </form>
                                    @endcan

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="10" class="text-center">

                                    No Cars Found

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

@endcan

@cannot('cars.view')
<div class="container mt-5">
    <div class="alert alert-danger">
        You do not have permission to access this page.
    </div>
</div>
@endcannot

@endsection
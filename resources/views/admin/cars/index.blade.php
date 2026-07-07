@extends('admin.frontend.webview.home')

@section('content')

@can('cars.view')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>All Cars</h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        Cars Uploaded By Users

                    </h3>

                </div>

                <div class="card-body p-0">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Image</th>

                                <th>Owner</th>

                                <th>Brand</th>

                                <th>Model</th>

                                <th>Registration</th>

                                <th>Fuel</th>

                                <th>Rent/Day</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($cars as $car)

                            <tr>

                                <td>{{ $car->id }}</td>

                                <td width="120">

                                    @if($car->image)

                                    <img src="{{ asset('uploads/cars/'.$car->image) }}"
                                        style="height:70px;width:110px;object-fit:cover;border-radius:8px;">

                                    @endif

                                </td>

                                <td>

                                    <strong>{{ $car->user->name }}</strong>

                                    <br>

                                    <small>{{ $car->user->email }}</small>

                                </td>

                                <td>{{ $car->brand }}</td>

                                <td>{{ $car->model }}</td>

                                <td>{{ $car->registration_number }}</td>

                                <td>{{ $car->fuel_type }}</td>

                                <td>

                                    ₹{{ number_format($car->rent_per_day) }}

                                </td>

                                <td>

                                    @can('cars.view')
                                    <a href="{{ route('admin.cars.show',$car->id) }}"
                                        class="btn btn-info btn-sm">
                                        View
                                    </a>
                                    @endcan

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    No Cars Found

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                                of {{ $cars->total() }} cars
                            </small>

                            {{ $cars->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

            </div>

        </div>

    </section>

</div>

@endcan

@cannot('cars.view')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid mt-3">
            <div class="alert alert-danger">
                You do not have permission to view cars.
            </div>
        </div>
    </section>
</div>
@endcannot

@endsection
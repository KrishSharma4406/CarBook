@extends('frontend.layout.app')
@section('content')

<div class="content-wrapper">

    <div class="card mb-3">

        <div class="card-body">

            <form>

                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group">

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search user by name or email">

                            <div class="input-group-append">

                                <button class="btn btn-primary">

                                    <i class="fas fa-search"></i>

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <section class="content">

        <div class="container-fluid">


            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> All User Cars</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped text-center align-middle">


                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Image</th>

                                <th>Owner</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Car Name</th>

                                <th>Brand</th>

                                <th>Model</th>

                                <th>Rent/Day</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($cars as $car)

                            <tr>

                                <td>{{ $car->id }}</td>

                                <td>

                                    @if($car->image)

                                    <img src="{{ asset('uploads/cars/'.$car->image) }}"
                                        width="80"
                                        height="60"
                                        style="object-fit:cover;border-radius:8px;">

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

                                    <span class="badge badge-success">

                                        Available

                                    </span>

                                </td>

                                <td>

                                    <a href="{{ route('admin.cars.show',$car->id) }}"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <form action="{{ route('admin.cars.destroy',$car->id) }}"
                                        method="POST"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this car?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="11" class="text-center">

                                    No Cars Found

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer">
                    {{ $cars->links() }}
                </div>

            </div>

        </div>

    </section>

</div>
@endsection
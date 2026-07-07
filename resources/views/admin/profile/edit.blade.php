@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between">

                <h1>Edit Profile</h1>

                <a href="{{ route('admin.profile.index') }}"
                    class="btn btn-secondary">
                    Back
                </a>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Update Profile</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Profile Image</label>

                            <input type="file"
                                name="profile_image"
                                class="form-control">

                            @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <label>Name</label>

                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name',$admin->name) }}">

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$admin->email) }}">

                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Profile
                </button>

                </form>

            </div>

        </div>

</div>

</section>

</div>

@endsection
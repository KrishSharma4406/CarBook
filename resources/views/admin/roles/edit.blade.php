@extends('admin.frontend.webview.home')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">Edit Role</h3>
                </div>

                <form action="{{ route('roles.update', $role->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label>Role Name</label>

                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $role->name) }}"
                                placeholder="Enter Role Name">

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <h4 class="mb-3">Assign Permissions</h4>

                        <div class="row">

                            @foreach($permissions as $permission)

                            <div class="col-md-3">

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        id="permission{{ $permission->id }}"

                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                    <label
                                        class="form-check-label"
                                        for="permission{{ $permission->id }}">

                                        {{ $permission->name }}

                                    </label>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Role

                        </button>

                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection
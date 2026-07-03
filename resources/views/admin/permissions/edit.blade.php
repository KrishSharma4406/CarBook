@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-edit"></i>
                        Edit Permission
                    </h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('permissions.index') }}"
                        class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card card-warning">

                <div class="card-header">

                    <h3 class="card-title">

                        Update Permission

                    </h3>

                </div>

                <form action="{{ route('permissions.update',$permission->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Module</label>

                                    <input
                                        type="text"
                                        id="module"
                                        name="module"
                                        class="form-control @error('module') is-invalid @enderror"
                                        value="{{ old('module', $module) }}"
                                        placeholder="Enter Module Name">

                                    @error('module')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Action</label>

                                    <select
                                        id="action"
                                        name="action"
                                        class="form-control">

                                        <option value="view" {{ $action=='view' ? 'selected' : '' }}>
                                            View
                                        </option>

                                        <option value="create" {{ $action=='create' ? 'selected' : '' }}>
                                            Create
                                        </option>

                                        <option value="edit" {{ $action=='edit' ? 'selected' : '' }}>
                                            Edit
                                        </option>

                                        <option value="delete" {{ $action=='delete' ? 'selected' : '' }}>
                                            Delete
                                        </option>

                                        <option value="approve" {{ $action=='approve' ? 'selected' : '' }}>
                                            Approve
                                        </option>

                                        <option value="reject" {{ $action=='reject' ? 'selected' : '' }}>
                                            Reject
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="callout callout-info">

                            <h5>

                                <i class="fas fa-lock"></i>

                                Permission Preview

                            </h5>

                            <h4 id="preview">

                                {{ strtolower($module) }}.{{ strtolower($action) }}

                            </h4>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                            class="btn btn-warning">

                            <i class="fas fa-save"></i>

                            Update Permission

                        </button>

                        <a href="{{ route('permissions.index') }}"
                            class="btn btn-secondary">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection

@section('scripts')

<script>
    function updatePreview() {
        let module = $('#module').val().toLowerCase().trim();
        let action = $('#action').val().toLowerCase();

        $('#preview').text(module + '.' + action);
    }

    $('#module').keyup(updatePreview);

    $('#action').change(updatePreview);
</script>

@endsection
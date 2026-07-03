@extends('admin.frontend.webview.home')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-6">

                    <h1>Create Role</h1>

                </div>

                <div class="col-md-6 text-right">

                    <a href="{{ route('roles.index') }}"
                        class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <form
                action="{{ route('roles.store') }}"
                method="POST">

                @csrf

                <div class="card">

                    <div class="card-header bg-primary">

                        <h3 class="card-title">

                            Role Details

                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label>

                                Role Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter Role Name">

                        </div>

                        <hr>

                        <div class="mb-3">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    id="selectAll">

                                <label>

                                    Select All Permissions

                                </label>

                            </div>

                        </div>

                        <div class="row">

                            @foreach($permissions as $module=>$modulePermissions)

                            <div class="col-md-4">

                                <div class="card card-outline card-primary">

                                    <div class="card-header">

                                        <strong>

                                            {{ ucfirst($module) }}

                                        </strong>

                                    </div>

                                    <div class="card-body">

                                        @foreach($modulePermissions as $permission)

                                        <div class="form-check">

                                            <input
                                                class="permission"

                                                type="checkbox"

                                                name="permissions[]"

                                                value="{{ $permission->name }}">

                                            <label>

                                                {{ ucfirst(last(explode('.',$permission->name))) }}

                                            </label>

                                        </div>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="card-footer">

                        <button
                            class="btn btn-success">

                            <i class="fas fa-save"></i>

                            Save Role

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection

@section('scripts')

<script>
    $('#selectAll').click(function() {

        $('.permission').prop(
            'checked',
            $(this).prop('checked')
        );

    });
</script>

@endsection
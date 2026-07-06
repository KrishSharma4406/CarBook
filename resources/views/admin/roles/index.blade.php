@extends('admin.frontend.webview.home')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1><i class="fas fa-user-shield"></i> Roles Management</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Role
                    </a>
                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        Roles List

                    </h3>

                </div>

                <div class="card-body">

                    <table id="rolesTable"
                        class="table table-bordered table-hover">

                        <thead class="bg-primary">

                            <tr>

                                <th width="5%">#</th>

                                <th>Role Name</th>

                                <th width="20%">Permissions</th>

                                <th width="25%">Assigned Permissions</th>

                                <th width="15%">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($roles as $role)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    <strong>

                                        {{ $role->name }}

                                    </strong>

                                </td>

                                <td>

                                    <span class="badge badge-info">

                                        {{ $role->permissions->count() }}

                                        Permissions

                                    </span>

                                </td>

                                <td>

                                    @foreach($role->permissions->take(5) as $permission)

                                    <span class="badge badge-success">

                                        {{ $permission->name }}

                                    </span>

                                    @endforeach

                                    @if($role->permissions->count()>5)

                                    <span class="badge badge-dark">

                                        +{{ $role->permissions->count()-5 }}

                                    </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('roles.edit',$role->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    @if($role->name!='Super Admin')

                                    <form
                                        action="{{ route('roles.destroy',$role->id) }}"
                                        method="POST"
                                        style="display:inline">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this role?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <div class="card-footer border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }}
                                of {{ $roles->total() }} roles
                            </small>

                            {{ $roles->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection

@section('scripts')

<script>
    $(function() {

        $('#rolesTable').DataTable();

    });
</script>

@endsection
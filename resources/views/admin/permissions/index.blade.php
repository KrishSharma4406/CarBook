@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-lock"></i>
                        Permission Management
                    </h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('permissions.create') }}"
                        class="btn btn-primary">

                        <i class="fas fa-plus"></i>

                        Create Permission

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

                        All Permissions

                    </h3>

                </div>

                <div class="card-body">

                    <table id="permissionTable"
                        class="table table-bordered table-hover">

                        <thead class="bg-primary">

                            <tr>

                                <th>#</th>

                                <th>Module</th>

                                <th>Action</th>

                                <th>Permission</th>

                                <th width="150">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($permissions as $permission)

                            @php

                            $parts = explode('.', $permission->name);

                            @endphp

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    <span class="badge badge-info">

                                        {{ ucfirst($parts[0]) }}

                                    </span>

                                </td>

                                <td>

                                    <span class="badge badge-success">

                                        {{ ucfirst($parts[1]) }}

                                    </span>

                                </td>

                                <td>

                                    <strong>

                                        {{ $permission->name }}

                                    </strong>

                                </td>

                                <td>

                                    <a href="{{ route('permissions.edit',$permission->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form
                                        action="{{ route('permissions.destroy',$permission->id) }}"
                                        method="POST"
                                        style="display:inline">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this permission?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection

@section('scripts')

<script>
    $(function() {

        $('#permissionTable').DataTable();

    });
</script>

@endsection
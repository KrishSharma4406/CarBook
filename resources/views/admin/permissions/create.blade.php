@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-6">

                    <h1>Create Permission</h1>

                </div>

                <div class="col-md-6 text-right">

                    <a href="{{ route('permissions.index') }}"
                        class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        Create Permission

                    </h3>

                </div>

                <form
                    action="{{ route('permissions.store') }}"
                    method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="form-group">

                            <label>

                                Module

                            </label>

                            <input
                                type="text"
                                id="module"
                                name="module"
                                class="form-control"
                                placeholder="Users">

                        </div>

                        <div class="form-group">

                            <label>

                                Action

                            </label>

                            <select
                                id="action"
                                name="action"
                                class="form-control">

                                <option value="view">View</option>

                                <option value="create">Create</option>

                                <option value="edit">Edit</option>

                                <option value="delete">Delete</option>

                            </select>

                        </div>

                        <hr>

                        <h5>

                            Permission Preview

                        </h5>

                        <div class="alert alert-info">

                            <strong id="preview">

                                users.view

                            </strong>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Save

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

        let module = $("#module").val().toLowerCase();

        let action = $("#action").val();

        $("#preview").text(module + "." + action);

    }

    $("#module").keyup(updatePreview);

    $("#action").change(updatePreview);
</script>

@endsection
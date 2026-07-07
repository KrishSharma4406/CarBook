@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">

                    <h3>

                        Assign Role

                    </h3>

                </div>

                <form
                    action="{{ route('users.role.update',$user) }}"
                    method="POST">

                    @csrf

                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">

                            <label>Name</label>

                            <input
                                class="form-control"
                                value="{{ $user->name }}"
                                readonly>

                        </div>

                        <div class="form-group">

                            <label>Email</label>

                            <input
                                class="form-control"
                                value="{{ $user->email }}"
                                readonly>

                        </div>

                        <div class="form-group">

                            <label>Role</label>

                            <select
                                name="role"
                                class="form-control">

                                @foreach($roles as $role)

                                <option

                                    value="{{ $role->name }}"

                                    {{ $user->hasRole($role->name)
? 'selected'
: '' }}>

                                    {{ $role->name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button
                            class="btn btn-success">

                            Save

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection
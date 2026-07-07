@extends('admin.frontend.layout.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>My Profile</h1>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.profile.edit') }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image items-center">
                        <img
                            src="{{ $admin->profile_image? asset('uploads/adminimg/'.$admin->profile_image): asset('UI/admin/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2"
                            width="120"
                            height="120"
                            style="object-fit:cover;">
                    </div><br>

                    <table class="table table-bordered">

                        <tr>
                            <th width="200">Name</th>
                            <td>{{ $admin->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $admin->email }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>
                                {{ $admin->roles->pluck('name')->implode(', ') }}
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
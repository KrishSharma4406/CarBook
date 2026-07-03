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

            <div class="row">

                <div class="col-lg-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $activeUsers }}</h3>
                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $blockedUsers }}</h3>
                            <p>Blocked Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-slash"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">All Registered Users</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped text-center align-middle">

                        <thead class="bg-dark">

                            <tr>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th width="280">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                            <tr>

                                <td>{{ $user->id }}</td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <!-- Role -->
                                <td>

                                    @if($user->roles->count())

                                    <span class="badge badge-primary">

                                        {{ $user->roles->first()->name }}

                                    </span>

                                    @else

                                    <span class="badge badge-secondary">

                                        No Role

                                    </span>

                                    @endif

                                </td>

                                <!-- Status -->
                                <td>

                                    @if($user->status)

                                    <span class="badge badge-success">
                                        Active
                                    </span>

                                    @else

                                    <span class="badge badge-danger">
                                        Blocked
                                    </span>

                                    @endif

                                </td>

                                <td>{{ $user->created_at->format('d M Y') }}</td>

                                <td>

                                    <a href="{{ route('users.edit',$user->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('users.toggleStatus',$user->id) }}"
                                        method="POST"
                                        style="display:inline">

                                        @csrf

                                        @if($user->status)

                                        <button class="btn btn-danger btn-sm">

                                            <i class="fas fa-ban"></i>

                                            Block

                                        </button>

                                        @else

                                        <button class="btn btn-success btn-sm">

                                            <i class="fas fa-check"></i>

                                            Unblock

                                        </button>

                                        @endif

                                        <a href="{{ route('users.role.edit', $user->id) }}"
                                            class="btn btn-info btn-sm">

                                            <i class="fas fa-user-tag"></i>

                                            Role

                                        </a>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No Users Found

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </section>

</div>
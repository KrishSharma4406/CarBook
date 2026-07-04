@can('users.edit')
<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Edit User</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3>Edit User Details</h3>

                </div>

                <div class="card-body">

                    <form action="{{ route('users.update',$user->id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="form-group">

                            <label>Name</label>

                            <input type="text"
                                class="form-control"
                                name="name"
                                value="{{ old('name',$user->name) }}">

                        </div>

                        <div class="form-group">

                            <label>Email</label>

                            <input type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email',$user->email) }}">

                        </div>

                        @can('users.edit')
                        <button class="btn btn-primary ">

                            Update User

                        </button>
                        @endcan

                        <a href="{{ route('admin-users') }}"
                            class="btn btn-secondary">

                            Back

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>
@endcan
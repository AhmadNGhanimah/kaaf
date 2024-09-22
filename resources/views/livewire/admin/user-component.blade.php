<div>
    <h1>User Administration</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>User List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.toggleAdmin', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch ">
                                        <label class="form-check-label" for="toggleAdmin{{ $user->id }}">
                                            {{ $user->role_as ? 'Admin' : 'User' }}
                                        </label>
                                        <input class="form-check-input" type="checkbox"
                                            style=" transform: translate(23px, -20px);"
                                            id="toggleAdmin{{ $user->id }}" onchange="this.form.submit()"
                                            {{ $user->role_as ? 'checked' : '' }}
                                            {{ $user->email === 'admin@admin.com' ? 'disabled' : '' }}>

                                    </div>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

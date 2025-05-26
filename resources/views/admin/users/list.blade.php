@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Users List</h3>
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select name="role" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if ($user->active_status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button class="btn btn-sm {{ $user->active_status ? 'btn-danger' : 'btn-success' }}">
                                {{ $user->active_status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

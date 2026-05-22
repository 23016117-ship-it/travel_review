@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4 admin-toolbar">
        <h1 class="h3 mb-0">Users</h1>
        <div class="d-flex flex-wrap gap-2 w-100 w-md-auto admin-toolbar-actions">
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex flex-wrap gap-2 w-100 w-md-auto" data-auto-submit="true">
                <select name="role" class="form-select w-100 w-md-auto">
                    <option value="">All roles</option>
                    <option value="admin" @selected($role === 'admin')>Admin</option>
                    <option value="user" @selected($role === 'user')>User</option>
                </select>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary admin-btn admin-btn-primary">Add user</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->is_active ? 'Active' : 'Locked' }}</td>
                        <td class="text-center">
                            <div class="table-actions">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="d-inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-primary" type="submit">
                                        {{ $user->is_active ? 'Lock' : 'Unlock' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this user?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@endsection

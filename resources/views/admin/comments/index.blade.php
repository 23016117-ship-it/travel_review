@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4 admin-toolbar">
        <h1 class="h3 mb-0">Comments</h1>
        <form method="GET" action="{{ route('admin.comments.index') }}" class="d-flex flex-wrap gap-2 w-100 w-md-auto" data-auto-submit="true">
            <select name="status" class="form-select w-100 w-md-auto">
                <option value="">All statuses</option>
                <option value="pending" @selected($status === 'pending')>Pending</option>
                <option value="approved" @selected($status === 'approved')>Approved</option>
                <option value="rejected" @selected($status === 'rejected')>Rejected</option>
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle admin-table">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->review->title }}</td>
                        <td>{{ ucfirst($comment->status) }}</td>
                        <td class="text-center">
                            <div class="table-actions">
                                <form method="POST" action="{{ route('admin.comments.approve', $comment) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-success" type="submit">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.reject', $comment) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-warning" type="submit">Reject</button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this comment?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No comments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $comments->links() }}
@endsection

@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4 admin-toolbar">
        <h1 class="h3 mb-0">Reviews</h1>
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="d-flex flex-wrap gap-2 w-100 w-md-auto" data-auto-submit="true">
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
                    <th>Title</th>
                    <th>User</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $review->title }}</td>
                        <td>{{ $review->user?->name ?? 'Unknown user' }}</td>
                        <td>{{ $review->location?->name ?? 'Unknown location' }}</td>
                        <td>{{ ucfirst($review->status) }}</td>
                        <td class="text-center">
                            <div class="table-actions">
                                <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-success" type="submit">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reviews.reject', $review) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-warning" type="submit">Reject</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this review?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No reviews found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $reviews->links() }}
@endsection

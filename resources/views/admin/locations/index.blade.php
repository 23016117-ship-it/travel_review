@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4 admin-toolbar">
        <h1 class="h3 mb-0">Locations</h1>
        <div class="d-flex flex-wrap gap-2 w-100 w-lg-auto">
            <form method="GET" action="{{ route('admin.locations.index') }}" class="d-flex flex-wrap gap-2 w-100 w-md-auto">
                <input type="text" name="q" value="{{ $search }}" class="form-control flex-grow-1 w-100 w-md-auto" placeholder="Search">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-primary w-100 w-md-auto">Add location</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Category</th>
                    <th>Avg rating</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->region }}</td>
                        <td>{{ $location->category }}</td>
                        <td>{{ number_format($location->avg_rating, 1) }}</td>
                        <td class="text-center">
                            <div class="table-actions">
                                <a href="{{ route('admin.locations.show', $location) }}" class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.locations.destroy', $location) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this location?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No locations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $locations->links() }}
@endsection

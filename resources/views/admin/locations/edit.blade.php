@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Edit Location</h1>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.locations.update', $location) }}" enctype="multipart/form-data" class="card shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $location->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $location->address) }}" required>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Region</label>
                    <input type="text" name="region" class="form-control" value="{{ old('region', $location->region) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $location->category) }}" required>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($location->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
@endsection

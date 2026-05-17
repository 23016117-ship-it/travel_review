@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h4 mb-0">Write a review for {{ $location->name }}</h1>
                <a href="{{ route('locations.show', $location) }}" class="btn btn-outline-secondary">Back</a>
            </div>
            <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="location_id" value="{{ $location->id }}">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-primary" type="submit">Submit review</button>
            </form>
        </div>
    </div>
@endsection

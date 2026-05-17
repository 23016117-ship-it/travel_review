@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4">My Favorites</h1>

    <div class="row g-4">
        @forelse ($locations as $location)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($location->image)
                        <img src="{{ asset('storage/' . $location->image) }}" class="card-img-top" alt="{{ $location->name }}">
                    @else
                        <div class="bg-secondary-subtle" style="height: 180px;"></div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $location->name }}</h5>
                        <p class="card-text text-muted mb-2">{{ $location->region }}</p>
                        <a href="{{ route('locations.show', $location) }}" class="btn btn-outline-primary">View details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">You have no favorites yet.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $locations->links() }}
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Locations</h1>
        <form class="d-flex flex-wrap gap-2 align-items-center w-100 w-lg-auto" method="GET" action="{{ route('locations.index') }}">
            <input type="text" name="q" value="{{ $search }}" class="form-control flex-grow-1 w-100 w-md-auto" placeholder="Search by name or region">
            <input type="text" name="region" value="{{ $region }}" class="form-control flex-grow-1 w-100 w-md-auto" placeholder="Region">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

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
                        <p class="card-text text-muted mb-1">{{ $location->region }} · {{ $location->category }}</p>
                        <p class="card-text mb-2">Rating: {{ number_format($location->avg_rating, 1) }}/5</p>
                        <a href="{{ route('locations.show', $location) }}" class="btn btn-outline-primary">View details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No locations found.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $locations->links() }}
    </div>
@endsection

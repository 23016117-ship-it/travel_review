@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Locations</h1>
        <form class="d-flex flex-nowrap gap-2 align-items-center w-100 w-lg-auto" method="GET" action="{{ route('locations.index') }}">
            <input type="text" name="q" value="{{ $search }}" class="form-control flex-grow-1" placeholder="Search by name or region">
            <button type="submit" class="btn btn-primary flex-shrink-0">Search</button>
        </form>
    </div>

    <div class="row g-4">
        @forelse ($locations as $location)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm location-card">
                    <div class="location-card-media">
                        @if ($location->image)
                            <img src="{{ asset('storage/' . $location->image) }}" class="location-thumb" alt="{{ $location->name }}">
                        @else
                            <div class="location-thumb-placeholder"></div>
                        @endif
                    </div>
                    <div class="location-card-body">
                        <h5 class="location-card-title">{{ $location->name }}</h5>
                        <div class="location-card-meta">
                            <span class="location-card-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z" />
                                </svg>
                            </span>
                            <span>{{ $location->region }}</span>
                        </div>
                        <div class="location-card-rating">
                            <span class="location-card-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l2.92 6.26 6.88.62-5.2 4.52 1.54 6.6L12 16.9 5.86 20l1.54-6.6L2.2 8.88l6.88-.62L12 2z" />
                                </svg>
                            </span>
                            <span>{{ number_format($location->avg_rating, 1) }} Superb</span>
                        </div>
                        <a href="{{ route('locations.show', $location) }}" class="location-card-link">View details</a>
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

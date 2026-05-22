@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Location Details</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="h5">{{ $location->name }}</h2>
            <p class="text-muted">{{ $location->address }}</p>
            <p>Region: {{ $location->region }}</p>
            <p>Category: {{ $location->category }}</p>
            <p>Average rating: {{ number_format($location->avg_rating, 1) }}</p>
            <p>{{ $location->description }}</p>
            @if ($location->image)
                <img src="{{ asset('storage/' . $location->image) }}" class="img-fluid rounded" alt="{{ $location->name }}">
            @endif
        </div>
    </div>
@endsection

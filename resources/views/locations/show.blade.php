@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Location Details</h1>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm">
                @if ($location->image)
                    <img src="{{ asset('storage/' . $location->image) }}" class="card-img-top" alt="{{ $location->name }}">
                @else
                    <div class="bg-secondary-subtle" style="height: 260px;"></div>
                @endif
                <div class="card-body">
                    <h2 class="h4">{{ $location->name }}</h2>
                    <p class="text-muted mb-1">{{ $location->address }}</p>
                    <p class="mb-1">Region: {{ $location->region }}</p>
                    <p class="mb-1">Category: {{ $location->category }}</p>
                    <p class="mb-2">Average rating: {{ number_format($location->avg_rating, 1) }}/5</p>

                    @auth
                        <form method="POST" action="{{ route('favorites.toggle', $location) }}">
                            @csrf
                            <button class="btn btn-outline-primary" type="submit">
                                {{ $isFavorite ? 'Remove favorite' : 'Add to favorites' }}
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h5">Description</h3>
                    <p>{{ $location->description }}</p>
                </div>
            </div>

            @auth
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5">Your rating</h3>
                        @if ($userRating)
                            <p class="mb-0">You rated this location: {{ $userRating->score }}/5</p>
                        @else
                            <form method="POST" action="{{ route('ratings.store') }}">
                                @csrf
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-4">
                                        <label class="form-label d-block">Score</label>
                                        <div class="btn-group" role="group" aria-label="Rating score">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" class="btn-check" name="score" id="score-{{ $i }}" value="{{ $i }}" autocomplete="off" @checked(old('score') == $i) required>
                                                <label class="btn btn-outline-warning" for="score-{{ $i }}">{{ $i }} ★</label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Comment</label>
                                        <input type="text" name="comment" class="form-control" placeholder="Short comment">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit rating</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @endauth

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="h5 mb-0">Reviews</h3>
                @auth
                    <a href="{{ route('reviews.create', $location) }}" class="btn btn-outline-secondary">Write review</a>
                @endauth
            </div>

            @forelse ($location->reviews as $review)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h4 class="h6">{{ $review->title }}</h4>
                        <p class="text-muted mb-2">By {{ $review->user->name }}</p>
                        <p>{{ $review->content }}</p>

                        <div class="mt-3">
                            <h5 class="h6">Comments</h5>
                            @forelse ($review->comments as $comment)
                                <div class="border rounded p-2 mb-2">
                                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                                </div>
                            @empty
                                <p class="text-muted">No comments yet.</p>
                            @endforelse
                        </div>

                        @auth
                            <form method="POST" action="{{ route('comments.store') }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <div class="input-group">
                                    <input type="text" name="content" class="form-control" placeholder="Write a comment" required>
                                    <button class="btn btn-outline-primary" type="submit">Send</button>
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No approved reviews yet.</div>
            @endforelse
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Location;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(StoreRatingRequest $request)
    {
        $data = $request->validated();

        $existing = Rating::where('location_id', $data['location_id'])
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing) {
            return back()->withErrors(['score' => 'You already rated this location.']);
        }

        Rating::create([
            'score' => $data['score'],
            'comment' => $data['comment'] ?? null,
            'user_id' => $request->user()->id,
            'location_id' => $data['location_id'],
        ]);

        $avg = Rating::where('location_id', $data['location_id'])->avg('score');
        Location::where('id', $data['location_id'])->update([
            'avg_rating' => round((float) $avg, 2),
        ]);

        return back()->with('success', 'Rating submitted.');
    }
}

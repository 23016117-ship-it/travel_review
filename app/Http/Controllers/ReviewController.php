<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Location;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create(Location $location)
    {
        return view('reviews.create', compact('location'));
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }

        $data['user_id'] = $request->user()->id;
        $data['status'] = 'pending';

        Review::create($data);

        return redirect()
            ->route('locations.show', $data['location_id'])
            ->with('success', 'Review submitted and awaiting approval.');
    }
}

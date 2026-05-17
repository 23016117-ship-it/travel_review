<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();

        $reviews = Review::query()
            ->with(['user', 'location'])
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reviews.index', compact('reviews', 'status'));
    }

    public function approve(Review $review)
    {
        $review->update(['status' => 'approved']);

        return back()->with('success', 'Review approved.');
    }

    public function reject(Review $review)
    {
        $review->update(['status' => 'rejected']);

        return back()->with('success', 'Review rejected.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Rating;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();
        $region = $request->string('region')->toString();

        $query = Location::query()
            ->withCount(['reviews' => function ($reviewQuery) {
                $reviewQuery->where('status', 'approved');
            }]);

        if ($search !== '') {
            $query->where(function ($filterQuery) use ($search) {
                $filterQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%");
            });
        }

        if ($region !== '') {
            $query->where('region', $region);
        }

        $locations = $query->orderByDesc('created_at')->paginate(9)->withQueryString();

        return view('locations.index', compact('locations', 'search', 'region'));
    }

    public function show(Location $location)
    {
        $location->load([
            'user',
            'ratings',
            'reviews' => function ($reviewQuery) {
                $reviewQuery->where('status', 'approved')
                    ->with(['user', 'comments' => function ($commentQuery) {
                        $commentQuery->where('status', 'approved')->with('user');
                    }]);
            },
        ]);

        $userRating = null;
        $isFavorite = false;

        if (auth()->check()) {
            $userRating = Rating::where('location_id', $location->id)
                ->where('user_id', auth()->id())
                ->first();

            $isFavorite = auth()->user()
                ->favorites()
                ->where('location_id', $location->id)
                ->exists();
        }

        return view('locations.show', compact('location', 'userRating', 'isFavorite'));
    }
}

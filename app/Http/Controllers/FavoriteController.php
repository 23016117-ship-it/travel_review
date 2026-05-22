<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Location;

class FavoriteController extends Controller
{
    public function index()
    {
        $locations = auth()->user()
            ->favoriteLocations()
            ->orderByDesc('favorites.created_at')
            ->paginate(9);

        return view('favorites.index', compact('locations'));
    }

    public function toggle(Location $location)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('location_id', $location->id)
            ->first();

        if ($favorite) {
            $favorite->delete();

            return back()->with('success', 'Removed from favorites.');
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'location_id' => $location->id,
        ]);

        return back()->with('success', 'Added to favorites.');
    }
}

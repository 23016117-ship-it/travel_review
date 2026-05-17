<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Location;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'locations' => Location::count(),
            'reviews' => Review::count(),
            'comments' => Comment::count(),
        ];

        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $reviewStats = Review::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', $start)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $reviewStats->pluck('month');
        $chartValues = $reviewStats->pluck('total');

        return view('admin.dashboard', compact('stats', 'chartLabels', 'chartValues'));
    }
}

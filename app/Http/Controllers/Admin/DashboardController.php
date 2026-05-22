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
        $months = [];

        for ($i = 0; $i < 6; $i++) {
            $months[] = $start->copy()->addMonths($i)->format('Y-m');
        }

        $reviewStats = Review::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', $start)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        $chartLabels = $months;
        $chartValues = array_map(static function ($month) use ($reviewStats) {
            return (int) ($reviewStats[$month] ?? 0);
        }, $months);

        return view('admin.dashboard', compact('stats', 'chartLabels', 'chartValues'));
    }
}

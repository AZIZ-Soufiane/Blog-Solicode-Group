<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Dashboard\DashboardStatsService;

class DashboardAdminController extends Controller
{
    protected DashboardStatsService $stats;

    public function __construct(DashboardStatsService $stats)
    {
        $this->stats = $stats;
  
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function stats()
    {
        return response()->json([
           
            'publishedArticles' => $this->stats->publishedArticles(),
            'totalViews'        => $this->stats->totalViews(),
            'totalUsers'        => $this->stats->totalUsers(),
            'totalComments'     => $this->stats->totalComments(),
            'newComments'       => $this->stats->newComments(),
            'latestArticles'    => $this->stats->latestArticles(),
            'percentage_growth' => $this->stats->thisMonthViewsPercentage(),
            'recentActivity'    => $this->stats->recentActivity(3),
        ]);
    }
}

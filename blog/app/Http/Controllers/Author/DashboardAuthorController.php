<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Services\Author\Dashboard\AuthorDashboardStatsService;

class DashboardAuthorController extends Controller
{
    protected AuthorDashboardStatsService $stats;

    public function __construct(AuthorDashboardStatsService $stats)
    {
        $this->stats = $stats;
    }

    public function index(int $userId)
    {
        return view('author.dashboard', compact('userId'));
    }

    public function stats(int $userId)
    {
        return response()->json([
            'myArticles' => $this->stats->myArticlesCount($userId),
            'myPublishedArticles' => $this->stats->myPublishedArticles($userId),
            'myDraftArticles' => $this->stats->myDraftArticles($userId),
            'myTotalViews' => $this->stats->myTotalViews($userId),
            'myRecentActivity' => $this->stats->myRecentActivity($userId, 3),
        ]);
    }
}

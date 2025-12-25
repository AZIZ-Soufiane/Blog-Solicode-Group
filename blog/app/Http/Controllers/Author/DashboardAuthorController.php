<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\Author\Dashboard\AuthorDashboardStatsService;

class DashboardAuthorController extends Controller
{
 protected ArticleService $articles;



public function __construct(
    ArticleService $articles,

) {
    $this->articles = $articles;

}

    public function index(int $userId)
    {
        return view('author.dashboard', compact('userId'));
    }

    public function stats(int $userId)
    {
        return response()->json([
            'myArticles' => $this->articles->myArticlesCount($userId),
            'myPublishedArticles' => $this->articles->myPublishedArticles($userId),
            'myDraftArticles' => $this->articles->myDraftArticles($userId),
            'myTotalViews' => $this->articles->myTotalViews($userId),
            'myRecentActivity' => $this->articles->myRecentActivity($userId, 3),
        ]);
    }
}

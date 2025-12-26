<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CommentsService;
use App\Services\UsersService;

class DashboardAdminController extends Controller
{
    protected ArticleService $articles;
    protected CommentsService $comments;
    protected UsersService $users;

    public function __construct(
        ArticleService $articles,
        CommentsService $comments,
        UsersService $users
    ) {
        $this->articles = $articles;
        $this->comments = $comments;
        $this->users = $users;
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function stats()
    {
        return response()->json([

            'publishedArticles' => $this->articles->publishedArticles(),
            'totalViews' => $this->articles->totalViews(),
            'totalUsers' => $this->users->totalUsers(),
            'totalComments' => $this->comments->totalComments(),
            'newComments' => $this->comments->newComments(),
            'latestArticles' => $this->articles->latestArticles(),
            'percentage_growth' => $this->articles->thisMonthViewsPercentage(),
            'recentActivity' => $this->articles->recentActivity(3),
        ]);
    }
}

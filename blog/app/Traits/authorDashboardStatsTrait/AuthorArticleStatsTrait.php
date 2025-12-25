<?php

namespace App\Traits\authorDashboardStatsTrait; 

use App\Models\Article;

trait AuthorArticleStatsTrait
{
    public function myArticlesCount(int $userId): int
    {
        return Article::where('user_id', $userId)->count();
    }

    public function myPublishedArticles(int $userId): int
    {
        return Article::where('user_id', $userId)
            ->where('status', 'published')
            ->count();
    }

    public function myDraftArticles(int $userId): int
    {
        return Article::where('user_id', $userId)
            ->where('status', 'draft')
            ->count();
    }

    public function myTotalViews(int $userId): string|int
    {
        $views = Article::where('user_id', $userId)->sum('view_count');

        if ($views >= 1000000) {
            return round($views / 1000000, 1) . 'M'; 
        } elseif ($views >= 1000) {
            return round($views / 1000, 1) . 'k';   
        }

        return $views;
    }

    public function myLatestArticles(int $userId, int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Article::where('user_id', $userId)
            ->with('user')
            ->latest()
            ->take($limit)
            ->get();
    }
}

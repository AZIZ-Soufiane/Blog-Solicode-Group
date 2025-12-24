<?php

namespace App\Traits\DashboardstatsTrait; 

use App\Models\Article;

trait ArticleStatsTrait
{
    public function totalArticles()
    {
        return Article::count();
    }

    public function publishedArticles()
    {
        return Article::where('status', 'published')->count();
    }

    public function totalViews()
    {
        $views = Article::sum('view_count');

        if ($views >= 1000000) {
            $views = round($views / 1000000, 1) . 'M'; 
        } elseif ($views >= 1000) {
            $views = round($views / 1000, 1) . 'k';   
        }

        return $views;
    }

public function thisMonthViewsPercentage(): float
{
    $now = now();
    $currentMonthStart = $now->copy()->startOfMonth();


    $totalViews = Article::sum('view_count');

    if ($totalViews <= 0) {
        return 0;
    }

    // Views this month
    $currentMonthViews = Article::where('created_at', '>=', $currentMonthStart)
        ->sum('view_count');

    // Percentage calculation
    $percentage = ($currentMonthViews / $totalViews) * 100;

    return round($percentage, 2);
}

    public function latestArticles(int $limit = 5)
    {
        return Article::with('user')
            ->latest()
            ->take($limit)
            ->get();
    }
}






































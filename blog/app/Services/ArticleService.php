<?php

namespace App\Services;

use App\Models\Article;

use App\Services\Traits\CommentsTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Services\Traits\BaseServiceTrait;
use App\Services\CommentsService;

class ArticleService
{
    use BaseServiceTrait;
    use CommentsTrait;

    /**
     * Get featured article for homepage
     */
    public function getFeaturedArticle(): ?Article
    {
        $featuredArticle = Article::where('is_featured', true)
            ->where('status', 'published')
            ->withCount('comments')
            ->latest()
            ->first();

        // If no featured article, just take the latest one
        if (!$featuredArticle) {
            $featuredArticle = Article::where('status', 'published')
                ->withCount('comments')
                ->latest()
                ->first();
        }

        return $featuredArticle;
    }

    /**
     * Get latest articles for homepage
     */
    public function getLatestArticles(int $limit = 6, ?int $excludeId = null): Collection
    {
        $query = Article::where('status', 'published')
            ->with(['user', 'tags', 'categories'])
            ->withCount('comments');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Search articles with filters and pagination
     */
    public function searchArticles(array $filters = []): LengthAwarePaginator
    {
        $query = Article::where('status', 'published')
            ->with(['user', 'tags', 'categories'])
            ->withCount('comments');

        // Apply search filter
        if (!empty($filters['q'])) {
            $this->applySearchFilter($query, $filters['q'], ['title', 'content']);
        }

        // Apply category filter
        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // Apply tag filter
        if (!empty($filters['tag'])) {
            $query->whereHas('tags', function ($q) use ($filters) {
                $q->where('slug', $filters['tag']);
            });
        }

        $this->applyOrder($query);
        return $this->paginateQuery($query, 9);
    }

    /**
     * Get article by slug with all relationships
     */
    public function getArticleBySlug(string $slug): Article
    {
        return Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['user', 'tags', 'categories', 'comments.user'])
            ->firstOrFail();
    }

    /**
     * Get article with all relationships for display and increment view count
     */
    public function getArticleForView(Article $article): Article
    {
        // Use existing method to load and validate
        $article = $this->getArticleForDisplay($article);

        // Increment view count
        $this->incrementViewCount($article);

        return $article;
    }

    /**
     * Get article with all relationships for display
     * Validates article is published and loads all necessary relationships
     */
    public function getArticleForDisplay(Article $article): Article
    {
        // Validate article is published
        if ($article->status !== 'published') {
            abort(404);
        }

        // Load all relationships
        $article->load(['user', 'tags', 'categories', 'comments.user']);

        return $article;
    }

    /**
     * Increment article view count
     */
    public function incrementViewCount(Article $article): void
    {
        $article->increment('view_count');
    }

 /**
     * start :  parte admin dashboard stats
     */

    public function recentActivity(int $limit = 4): array
    {
        $activities = [];

        foreach ($this->latestArticles($limit) as $article) {
            $activities[] = [
                'type' => 'article',
                'title' => 'Article publié',
                'message' => 'Vous avez publié "' . $article->title . '".',
                'user' => $article->user->name ?? 'Auteur inconnu',
                'time' => $article->created_at->diffForHumans(),
            ];
        }

        foreach ($this->latestComments($limit) as $comment) {
            $activities[] = [
                'type' => 'comment',
                'title' => 'Nouveau commentaire',
                'message' => ($comment->user->name ?? 'Un utilisateur') . ' a commenté "' . ($comment->article->title ?? '') . '".',
                'user' => $comment->user->name ?? 'Utilisateur inconnu',
                'time' => $comment->created_at->diffForHumans(),
            ];
        }

        usort($activities, fn($a, $b) => strtotime($b['time']) - strtotime($a['time']));

        return array_slice($activities, 0, $limit);
    }

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

/**
     * end :  parte admin dashboard stats
     */

}


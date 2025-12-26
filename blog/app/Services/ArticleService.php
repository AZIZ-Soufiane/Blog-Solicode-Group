<?php

namespace App\Services;

use App\Models\Article;

use App\Services\Traits\UploadTrait;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Services\Traits\CommentsTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Services\Traits\BaseServiceTrait;
use App\Services\CommentsService;

class ArticleService
{
    use BaseServiceTrait;
    use CommentsTrait;
    use UploadTrait;

    /**
     * Get paginated articles for admin with filters
     */
    public function getPaginatedArticles(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Article::with(['user', 'categories', 'tags'])
            ->withCount('comments');

        // Search by title
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        // Filter by category
        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // Filter by status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function store(array $data): Article
    {
        $imagePath = isset($data['image'])
            ? $this->uploadImage($data['image'])
            : null;

        $article = Article::create([
            'title'       => $data['title'],
            'slug'        => $data['slug'] ?? Str::slug($data['title']),
            'content'     => $data['content'],
            'image'       => $imagePath,
            'status'      => $data['status'] ?? 'draft',
            'is_featured' => !empty($data['is_featured']),
            'user_id'     => 1, // Sprint 2
        ]);

        // ✅ Categories (existantes uniquement)
        if (!empty($data['categories'])) {
            $article->categories()->attach($data['categories']);
        }

        // ✅ Tags (existants + nouveaux)
        if (!empty($data['tags'])) {
            $tagIds = $this->handleTags($data['tags']);
            $article->tags()->attach($tagIds);
        }

        // Upload videos
        if (!empty($data['videos'])) {
            $this->uploadVideos($data['videos'], $article);
        }

        return $article;
    }

    public function update(Article $article, array $data): Article
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        } elseif (isset($data['remove_image']) && $data['remove_image'] == '1') {
            $data['image'] = null;
        } else {
            $data['image'] = $article->image;
        }

        $article->update([
            'title'       => $data['title'],
            'slug'        => $data['slug'] ?? $article->slug,
            'content'     => $data['content'],
            'image'       => $data['image'],
            'status'      => $data['status'],
            'is_featured' => !empty($data['is_featured']),
        ]);

        // Sync categories
        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        // Sync tags (avec création si besoin)
        if (isset($data['tags'])) {
            $tagIds = $this->handleTags($data['tags']);
            $article->tags()->sync($tagIds);
        }

        // Upload videos
        if (!empty($data['videos'])) {
            $this->uploadVideos($data['videos'], $article);
        }

        return $article;
    }

    /**
     * Handle existing & new tags
     */
    private function handleTags(string|array $tags): array
    {
        // Si input text: "Laravel, PHP, Docker"
        if (is_string($tags)) {
            $tags = explode(',', $tags);
        }

        $tagIds = [];

        foreach ($tags as $tagName) {
            $tagName = trim($tagName);

            if ($tagName === '') {
                continue;
            }

            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );

            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

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

        return $featuredArticle;
    }

    /**
     * Get latest articles for homepage
     */
    public function getLatestArticles(int $limit = 6, ?int $excludeId = null, bool $onlyFeatured = false): Collection
    {
        $query = Article::where('status', 'published')
            ->with(['user', 'tags', 'categories'])
            ->withCount('comments');

        if ($onlyFeatured) {
            $query->where('is_featured', true);
        }

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
            ->with(['user', 'tags', 'categories', 'comments.user', 'videos'])
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
        $article->load(['user', 'tags', 'categories', 'comments.user', 'videos']);

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




/**
     * start :  parte admin dashboard Author stats
     */
    public function myRecentActivity(int $userId, int $limit = 4): array
    {
        $activities = [];

        $articles = Article::where('user_id', $userId)
            ->with('user')
            ->latest('updated_at')
            ->take($limit * 2)
            ->get();

        foreach ($articles as $article) {
            if ($article->status === 'draft') {
                $activities[] = [
                    'type' => 'draft',
                    'icon' => 'edit-3',
                    'color' => 'blue',
                    'title' => 'Brouillon sauvegardé',
                    'message' => 'Vous avez modifié "' . $article->title . '".',
                    'time' => $article->updated_at->diffForHumans(),
                    'timestamp' => $article->updated_at->timestamp,
                ];
            } elseif ($article->status === 'published') {
                $activities[] = [
                    'type' => 'published',
                    'icon' => 'check-circle',
                    'color' => 'green',
                    'title' => 'Article validé',
                    'message' => 'Votre article "' . $article->title . '" a été publié.',
                    'time' => $article->updated_at->diffForHumans(),
                    'timestamp' => $article->updated_at->timestamp,
                ];
            }
        }

        usort($activities, fn($a, $b) => $b['timestamp'] - $a['timestamp']);

        return array_slice($activities, 0, $limit);
    }

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


    /**
     * end :  parte admin dashboard Author stats
     */
}


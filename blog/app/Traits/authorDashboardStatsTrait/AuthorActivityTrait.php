<?php

namespace App\Traits\authorDashboardStatsTrait; 

use App\Models\Article;

trait AuthorActivityTrait
{
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
}

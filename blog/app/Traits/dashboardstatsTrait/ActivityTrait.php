<?php

namespace App\Traits\DashboardstatsTrait; 

trait ActivityTrait
{
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
}

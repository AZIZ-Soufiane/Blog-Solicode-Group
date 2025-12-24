<?php

namespace App\Traits\dashboardstatsTrait; 

use App\Models\Comment;

trait CommentStatsTrait
{
    public function totalComments(): int
    {
        return Comment::count();
    }

    public function newComments(): int
    {
        return Comment::where('status', 'pending')->count();
    }

    public function latestComments(int $limit = 5)
    {
        return Comment::with('user', 'article')
            ->latest()
            ->take($limit)
            ->get();
    }
}

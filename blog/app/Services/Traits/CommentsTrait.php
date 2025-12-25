<?php

namespace App\Services\Traits;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

trait CommentsTrait
{

    public function latestComments(int $limit = 5)
    {
        return Comment::with('user', 'article')
            ->latest()
            ->take($limit)
            ->get();
    }

}
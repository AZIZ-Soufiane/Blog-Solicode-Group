<?php

namespace App\Services;

use App\Models\Comment;

use App\Services\Traits\CommentsTrait;
use Illuminate\Support\Collection;


class CommentsService {
    use CommentsTrait;
    public function totalComments(): int
    {
        return Comment::count();
    }

    public function newComments(): int
    {
        return Comment::where('status', 'pending')->count();
    }

  
}
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'path',
        'original_name',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

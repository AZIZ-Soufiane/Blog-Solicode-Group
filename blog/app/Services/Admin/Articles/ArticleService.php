<?php

namespace App\Services\Admin\Articles;

use App\Models\Article;
use App\Models\Tag;
use App\Traits\articlesTraits\UploadTrait;
use Illuminate\Support\Str;

class ArticleService
{
    use UploadTrait;

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
}

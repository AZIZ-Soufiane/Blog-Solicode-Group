<?php

namespace App\Services\Traits;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    /**
     * Upload d'une image et retourne le chemin
     */
    public function uploadImage($file)
    {
        if ($file) {
            return $file->store('images/articles', 'public'); // stockage dans storage/app/public/images/articles
        }
        return null;
    }

    /**
     * Upload de plusieurs vidéos et création des enregistrements liés à l'article
     */
    public function uploadVideos($files, $article)
    {
        if (!$files) return null; // si aucune vidéo, ne rien faire

        $paths = [];
        foreach ($files as $file) {
            $path = $file->store('videos', 'public'); // stockage dans storage/app/public/videos
            $article->videos()->create([
                'path'          => $path,
                'original_name' => $file->getClientOriginalName(),
            ]); // crée l'enregistrement dans la table videos
            $paths[] = $path;
        }
        return $paths;
    }
}

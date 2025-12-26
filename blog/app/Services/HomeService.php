<?php

namespace App\Services;

class HomeService extends BaseService
{

    public function __construct(
        protected ArticleService $articleService
    ) {
    }

    /**
     * Get all data required for the homepage
     */
    public function getHomePageData(): array
    {
        $featuredArticle = $this->articleService->getFeaturedArticle();
        $latestArticles = $this->articleService->getLatestArticles(6, null, true);

        return [
            'featuredArticle' => $featuredArticle,
            'latestArticles' => $latestArticles,
        ];
    }
}

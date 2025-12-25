<?php

namespace App\Services\Author\Dashboard;

use App\Traits\authorDashboardStatsTrait\AuthorArticleStatsTrait;
use App\Traits\authorDashboardStatsTrait\AuthorActivityTrait;

class AuthorDashboardStatsService
{
    use AuthorArticleStatsTrait,
        AuthorActivityTrait;
}

<?php

namespace App\Services\Admin\Dashboard;

use App\Traits\dashboardstatsTrait\ArticleStatsTrait;
use App\Traits\dashboardstatsTrait\UserStatsTrait;
use App\Traits\dashboardstatsTrait\CommentStatsTrait;
use App\Traits\dashboardstatsTrait\ActivityTrait;

class DashboardStatsService
{
    use 
      ArticleStatsTrait,
      UserStatsTrait,
      CommentStatsTrait,
      ActivityTrait;
}

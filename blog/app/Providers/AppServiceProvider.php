<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(\App\Services\CategoryService $categoryService): void
    {
        \Illuminate\Support\Facades\App::setLocale('fr');
        \Illuminate\Pagination\Paginator::useTailwind();

        \Illuminate\Support\Facades\View::composer(['Visitor.partials.nav', 'Visitor.search', 'Visitor.partials.header', 'Visitor.partials.footer'], function ($view) use ($categoryService) {
            $view->with('globalCategories', $categoryService->getCategories());
        });
    }
}
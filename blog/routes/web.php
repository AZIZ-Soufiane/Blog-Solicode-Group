<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Author\DashboardAuthorController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [ArticleController::class, 'index'])->name('articles.search');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');



Route::get('/dashboard', [DashboardAdminController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/dashboard/stats', [DashboardAdminController::class, 'stats'])
    ->name('admin.dashboard.stats');


Route::prefix('admin')->group(function () {

    // List articles
    Route::get('/articles', [AdminArticleController::class, 'index'])
        ->name('admin.articles.index');

    // Form create
    Route::get('/articles/create', [AdminArticleController::class, 'create'])
        ->name('admin.articles.create');

    // Store
    Route::post('/articles', [AdminArticleController::class, 'store'])
        ->name('admin.articles.store');

    // Form edit
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])
        ->name('admin.articles.edit');

    // Update
    Route::put('/articles/{article}', [AdminArticleController::class, 'update'])
        ->name('admin.articles.update');
});
// Author Dashboard Routes
Route::get('/author/dashboard/{userId}', [DashboardAuthorController::class, 'index'])
    ->name('author.dashboard');

Route::get('/author/dashboard/{userId}/stats', [DashboardAuthorController::class, 'stats'])
    ->name('author.dashboard.stats');


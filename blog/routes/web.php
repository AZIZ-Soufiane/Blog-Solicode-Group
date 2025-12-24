<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [ArticleController::class, 'index'])->name('articles.search');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');



Route::get('/dashboard', [DashboardAdminController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/dashboard/stats', [DashboardAdminController::class, 'stats'])
    ->name('admin.dashboard.stats');
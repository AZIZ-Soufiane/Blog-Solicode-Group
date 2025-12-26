<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'status']);

        // Force user_id filter
        $filters['user_id'] = auth()->id();

        // Handle "all" values
        if (isset($filters['category']) && $filters['category'] === 'all')
            unset($filters['category']);
        if (isset($filters['status']) && $filters['status'] === 'all')
            unset($filters['status']);

        $articles = $this->articleService->getPaginatedArticles(10, $filters);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('author.articles.partials.table', compact('articles'))->render();
        }

        return view('author.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.articles.create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $this->articleService->store($request->validated());

        return redirect()
            ->route('author.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorizeOwner($article);

        return view('author.articles.edit', [
            'article' => $article->load(['categories', 'tags']),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorizeOwner($article);

        $this->articleService->update($article, $request->validated());

        return redirect()
            ->route('author.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorizeOwner($article);

        $article->delete();

        return redirect()
            ->route('author.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }

    private function authorizeOwner(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet article.');
        }
    }
}

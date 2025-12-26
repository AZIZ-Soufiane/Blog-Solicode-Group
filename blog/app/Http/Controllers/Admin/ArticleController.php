<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'status']);
        
        // Handle "all" values from dropdowns
        if (isset($filters['category']) && $filters['category'] === 'all') {
            unset($filters['category']);
        }
        if (isset($filters['status']) && $filters['status'] === 'all') {
            unset($filters['status']);
        }

        $articles = $this->articleService->getPaginatedArticles(10, $filters);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.articles.partials.table', compact('articles'))->render();
        }

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create', [
            'categories' => Category::all(),
            'tags'       => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $this->articleService->store($request->validated());

        return redirect()
            ->route('admin.articles.index')
            ->with('success', __('articles.messages.created'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article'    => $article->load(['categories', 'tags']),
            'categories' => Category::all(),
            'tags'       => Tag::all(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->articleService->update($article, $request->validated());

        return redirect()
            ->route('admin.articles.index')
            ->with('success', __('articles.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $this->articleService->delete($article);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('articles.messages.deleted')
                ]);
            }

            return redirect()
                ->route('admin.articles.index')
                ->with('success', __('articles.messages.deleted'));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('articles.validation.error') // fallback or generic error
                ], 500);
            }

            return redirect()
                ->route('admin.articles.index')
                ->with('error', __('articles.validation.error'));
        }
    }
}

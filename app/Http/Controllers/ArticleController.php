<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::withSearch($request)->active()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Auth::user()->articles()->create($validated);

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('update-article', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        Gate::authorize('update-article', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        Gate::authorize('destroy-article', $article);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function deactivate(Article $article)
    {
        Gate::authorize('deactivate-article', $article);

        $article->is_active = false;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article deactivated successfully.');
    }
}

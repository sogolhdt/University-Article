<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $article = new Article();
        $articles = $article->getArticlesListWithSearch($request);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $articleData = [
            'title' => $request['title'],
            'body' => $request['body'],
        ];
        Auth::user()->articles()->create($articleData);

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update-article', $article);
        return view('articles.edit', compact('article'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        Gate::authorize('update-article', $article);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $articleData = [
            'title' => $request['title'],
            'body' => $request['body'],
        ];
        $article->update($articleData);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
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

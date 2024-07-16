<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('update-article', fn(User $user, Article $article) => $user->id === $article->user_id);
        Gate::define('deactivate-article', fn(User $user, Article $article) => $user->id === $article->user_id);
        Gate::define('destroy-article', fn(User $user, Article $article) => $user->id === $article->user_id);
    }
}

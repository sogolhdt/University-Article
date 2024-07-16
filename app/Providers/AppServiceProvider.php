<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;

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
    public function boot(): void
    {
        Gate::define('update-article', function (User $user, Article $article) {
            return $user->id === $article->user_id;
        });
        Gate::define('deactivate-article', function (User $user, Article $article) {
            return $user->id === $article->user_id;
        });
        Gate::define('destroy-article', function (User $user, Article $article) {
            return $user->id === $article->user_id;
        });
    }
}

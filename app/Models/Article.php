<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'is_active', 'user_id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getArticlesListWithSearch($request): Collection
    {
        $query = Article::query();

        if ($request->has('author')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('author') . '%');
            });
        }

        if ($request->has('topic')) {
            $query->where('title', 'like', '%' . $request->input('topic') . '%');
        }

        if ($request->has('keyword')) {
            $query->where('body', 'like', '%' . $request->input('keyword') . '%');
        }

        return $query->where('is_active', true)->get();

    }
}

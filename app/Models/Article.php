<?php

namespace App\Models;

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
}

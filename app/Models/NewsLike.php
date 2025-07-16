<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsLike extends Model
{
    protected $fillable = [
        'news_id',
        'user_id',
        'liked_at',
    ];

    protected $casts = [
        'liked_at' => 'datetime',
    ];

    /**
     * Get the news that was liked.
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Get the user who liked the news.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

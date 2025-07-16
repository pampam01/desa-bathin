<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    protected $guarded = [
        'id',        
    ];

    /**
     * Get the formatted published date.
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y H:i') : null;
    }

    /**
     * Scope a query to only include published news.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the likes for this news.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    /**
     * Get the comments for this news.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(NewComment::class);
    }
}

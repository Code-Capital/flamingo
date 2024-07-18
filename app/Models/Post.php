<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use DateFormattingTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'body',
        'is_private',
        'published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    // ======================================================================
    // Relationships
    // ======================================================================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notifications(): MorphMany
    {
        return $this->MorphMany(Notification::class, 'notifiable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->where('type', 'comment');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // ======================================================================
    // Accessors
    // ======================================================================

    // ======================================================================
    // Mutators
    // ======================================================================

    // ======================================================================
    // Custom Functions
    // ======================================================================

    /**
     * Check if the current user has liked the post.
     */
    public function likedByCurrentUser(): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false; // If user is not authenticated, return false
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likedByUser($id)
    {
        return $this->likes()->where('user_id', $id)->where('is_liked', true);
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeByPublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeByUnpublished($query)
    {
        return $query->where('published', false);
    }

    public function scopeByPrivate($query)
    {
        return $query->where('is_private', true);
    }

    public function scopeByPublic($query)
    {
        return $query->where('is_private', false);
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeByUsers($query, $users)
    {
        return $query->whereIn('user_id', $users->pluck('id'));
    }
}

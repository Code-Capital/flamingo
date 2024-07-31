<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use DateFormattingTrait;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_private',
        'user_id',
        'cover_image',
        'profile_image',
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
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'page_user', 'page_id', 'user_id')
            ->withPivot('start_date', 'end_date', 'is_invited')
            ->withTimestamps();
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class, 'page_interest', 'page_id', 'interest_id')
            ->withTimestamps();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function pendingUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'page_user', 'page_id', 'user_id')
            ->wherePivot('is_invited', true)
            ->wherePivot('status', StatusEnum::PENDING->value)
            ->withPivot('start_date', 'end_date', 'is_invited')
            ->withTimestamps();
    }

    public function acceptedUsers(): BelongsToMany
    {
        return $this->users()->wherePivot('status', StatusEnum::ACCEPTED->value);
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? Storage::url($this->cover_image) : asset('assets/placeholder.svg');
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? Storage::url($this->profile_image) : asset('assets/placeholder.svg');
    }

    // ======================================================================
    // Mutators
    // ======================================================================

    // ======================================================================
    // Custom Functions
    // ======================================================================
    public function isPrivate(): bool
    {
        return $this->is_private ? true : false;
    }

    public function isMainOwner($user)
    {
        return $this->user_id === $user->id;
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeBySearch($query, $search = null)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        });
    }

    public function scopeByInterests($query, array $interests = [])
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }

    public function scopeByNotUser($query, $userId)
    {
        return $query->where('user_id', '!=', $userId);
    }
}

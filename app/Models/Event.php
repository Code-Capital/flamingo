<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\DateFormattingTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Event extends Model
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
        'user_id',
        'title',
        'slug',
        'location_id',
        'start_date',
        'end_date',
        'thumbnail',
        'description',
        'rules',
        'status',
        'is_closed',
        'closed_at',
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
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // same relation uers and memeber just named it as for my own convinience
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function allMembers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')
            ->withPivot('status');
    }

    public function acceptedMembers()
    {
        return $this->allMembers()
            ->wherePivot('status', StatusEnum::ACCEPTED->value);
    }

    public function pendingRequests()
    {
        return $this->allMembers()
            ->wherePivot('status', StatusEnum::PENDING->value);
    }

    public function rejectedRequests()
    {
        return $this->allMembers()
            ->wherePivot('status', StatusEnum::REJECTED->value);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : asset('assets/galleryImage.png');
    }

    // ======================================================================
    // Mutators
    // ======================================================================

    // ======================================================================
    // Custom Functions
    // ======================================================================
    public function isOwner($user): bool
    {
        return $this->user_id === $user->id;
    }

    public function isMember($user): bool
    {
        return $this->users->contains($user);
    }

    public function isAccepted($user): bool
    {
        return $this->acceptedMembers->contains($user);
    }

    public function isPending($user): bool
    {
        return $this->pendingRequests->contains($user);
    }

    public function isRejected($user): bool
    {
        return $this->rejectedRequests->contains($user);
    }

    public function isOngoing(): bool
    {
        return $this->start_date < now() && $this->end_date > now();
    }

    public function isUpcoming(): bool
    {
        return $this->start_date > now();
    }

    public function isPast(): bool
    {
        return $this->end_date < now();
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isClosed(): bool
    {
        return $this->is_closed;
    }

    public function isNotClosed(): bool
    {
        return ! $this->is_closed;
    }

    public function closeEvent(): void
    {
        $this->update([
            'is_closed' => true,
            'closed_at' => now(),
        ]);
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeByUser($query, $id): Builder
    {
        return $query->where('user_id', $id);
    }

    public function scopeByNotUser($query, int $id)
    {
        return $query->where('user_id', '<>', $id);
    }

    public function scopePublished($query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeUpcoming($query): Builder
    {
        return $query->where('start_date', '>', now());
    }

    public function scopePast($query): Builder
    {
        return $query->where('end_date', '<', now());
    }

    public function scopeOngoing($query): Builder
    {
        return $query->where('start_date', '<', now())
            ->where('end_date', '>', now());
    }

    public function scopeBySearch($query, ?string $search = null)
    {
        if (! $search) {
            return $query;
        }

        return $query->where('title', 'like', '%'.$search.'%')
            ->orWhere('location', 'like', '%'.$search.'%')
            ->orWhere('slug', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%');
    }

    public function scopeByLocation($query, ?string $search = null)
    {
        $query->when($search, function ($q) use ($search) {
            $q->where('location_id', $search);
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
}

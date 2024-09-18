<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Builder;
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
        'channel_id',
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

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function channel()
    {
        return $this->belongsTo(ChChannel::class);
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : asset('assets/galleryImage.png');
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
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
    public function scopeByUser(Builder $query, $id): Builder
    {
        return $query->where('user_id', $id);
    }

    public function scopeByNotUser(Builder $query, int $id): Builder
    {
        return $query->where('user_id', '<>', $id);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->whereDate('start_date', '>', now()->format('Y-m-d'));
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->whereDate('end_date', '<', now()->format('Y-m-d'));
    }

    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('start_date', '<', now()->format('Y-m-d'))
            ->where('end_date', '>', now()->format('Y-m-d'));
    }

    public function scopeBySearch(Builder $query, ?string $search = null): Builder
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('title', 'like', '%' . $search . '%')
                // ->orWhere('location_id', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    public function scopeByLocation(Builder $query, ?int $locationId = null): Builder
    {
        return $query->when($locationId, function ($query) use ($locationId) {
            return $query->where('location_id', $locationId);
        });
    }

    public function scopeByInterests(Builder $query, array $interests = []): Builder
    {
        return $query->when($interests, function ($q) use ($interests) {
            return $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }
}

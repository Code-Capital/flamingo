<?php

namespace App\Models;

use App\Enums\EventRequestEnum;
use App\Models\Media;
use App\Traits\DateFormattingTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'location',
        'start_date',
        'end_date',
        'thumbnail',
        'description',
        'rules',
        'status',
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

    // same relation uers and memeber just named it as for my own convinience
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function allMembers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')
            ->withPivot('status');
    }

    public function acceptedMembers()
    {
        return $this->allMembers()
            ->wherePivot('status', EventRequestEnum::ACCEPTED);
    }

    public function pendingRequests()
    {
        return $this->allMembers()
            ->wherePivot('status', EventRequestEnum::PENDING);
    }

    public function rejectedRequests()
    {
        return $this->allMembers()
            ->wherePivot('status', EventRequestEnum::REJECTED);
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

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeByUser($query, $id): Builder
    {
        return $query->where('user_id', $id);
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
        if (!$search) {
            return $query;
        }
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
    }

    public function scopeByInterests($query, array $interests = [])
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }

    public function scopeByNotUser($query, int $id)
    {
        return $query->where('id', '!=', $id);
    }
}

<?php

namespace App\Models;

use App\Models\Media;
use App\Traits\DateFormattingTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}

<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use DateFormattingTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'event_id', 'slug', 'title', 'body', 'start_date', 'end_date', 'is_active',
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

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getStartDateAttribute($value)
    {
        return $this->formatDate($value);
    }

    public function getEndDateAttribute($value)
    {
        return $this->formatDate($value);
    }

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
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getStatus(): string
    {
        return ($this->status == 1) ? 'Active' : 'Inactive';
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    public function scopeByUser($query, $id)
    {
        return $query->where('user_id', $id);
    }

    public function scopeByNotUser($query, $id)
    {
        return $query->where('user_id', '<>', $id);
    }

    public function scopeByEvent($query, $id)
    {
        return $query->where('event_id', $id);
    }
}

<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use DateFormattingTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_path', 'file_type', 'mediable_id', 'mediable_type',
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

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getFilePathAttribute($value): string
    {
        // Check if $value is a valid URL
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value; // Return the URL directly if it's valid
        }

        // Otherwise, concatenate with storage URL
        return Storage::url($value);
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
    public function scopeByType($query, string $type): void
    {
        $query->where('file_type', $type);
    }

    public function scopeByPath($query, string $path): void
    {
        $query->where('file_path', $path);
    }
}

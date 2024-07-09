<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'is_liked',
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

    public function likeable(): MorphTo
    {
        return $this->morphTo();
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

    // ======================================================================
    // Scopes
    // ======================================================================

}

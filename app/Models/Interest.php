<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    // ======================================================================
    // Relationships
    // ======================================================================
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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

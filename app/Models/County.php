<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;
    use DateFormattingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       //
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

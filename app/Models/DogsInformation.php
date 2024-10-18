<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogsInformation extends Model
{
    use HasFactory;
    use DateFormattingTrait;

    protected $table = "dogs_information";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
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

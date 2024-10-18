<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    public $incrementing = false; // UUID is not auto-incrementing
    protected $keyType = 'string'; // Ensure the id is treated as a string

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Define any data type casts here if needed
    ];

    // ======================================================================
    // Relationships
    // ======================================================================

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    // ======================================================================
    // Boot Method to Automatically Generate UUID
    // ======================================================================

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for the id field when creating a new notification
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // ======================================================================
    // Custom Functions, Mutators, Accessors, Scopes
    // ======================================================================
}

<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use HasFactory;
    use DateFormattingTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_private',
        'user_id',
        'cover_image',
        'profile_image',
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
    public function users()
    {
        return $this->belongsToMany(User::class, 'page_user', 'page_id', 'user_id')
            ->withPivot('start_date', 'end_date', 'is_invited')
            ->withTimestamps();
    }

    public function isMainOwner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'page_interest', 'page_id', 'interest_id')
            ->withTimestamps();
    }


    // ======================================================================
    // Accessors
    // ======================================================================
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? Storage::url($this->cover_image) : asset('assets/placeholder.svg');
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? Storage::url($this->profile_image) : asset('assets/placeholder.svg');
    }


    // ======================================================================
    // Mutators
    // ======================================================================


    // ======================================================================
    // Custom Functions
    // ======================================================================
    public function isPrivate(): bool
    {
        return $this->is_private ? true : false;
    }


    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeByInterests($query, array $interests = [])
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }
}

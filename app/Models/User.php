<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'email',
        'avatar',
        'email_verified_at',
        'password',
        'remember_token',
        'gender',
        'age',
        'country',
        'state',
        'bio',
    ];

    protected $appends = [
        'full_name',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ======================================================================
    // Relationships
    // ======================================================================

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    // social relationships
    public function feed(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'friends', 'user_id', 'friend_id')
            ->where('published', true)
            ->orWhere('user_id', $this->id)
            ->orderBy('created_at', 'desc');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Like::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // Friends Relationships
    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function acceptedFriends(): BelongsToMany
    {
        return $this->friends()
            ->wherePivot('status', StatusEnum::ACCEPTED->value);
    }

    public function blockedFriends(): BelongsToMany
    {
        return $this->friends()
            ->wherePivot('status', StatusEnum::BLOCKED->value);
    }

    public function rejectedFriends(): BelongsToMany
    {
        return $this->friends()
            ->wherePivot('status', StatusEnum::REJECTED->value);
    }

    public function sentRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('status')
            ->wherePivot('status', StatusEnum::PENDING->value);
    }

    public function receivedRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('status')
            ->wherePivot('status', StatusEnum::PENDING->value);
    }

    // visitors
    public function visitedProfiles(): HasMany
    {
        return $this->hasMany(Visitor::class, 'visitor_id');
    }

    public function profileVisits(): HasMany
    {
        return $this->hasMany(Visitor::class, 'profile_id');
    }

    // Events Relationships
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    public function participatedEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_users', 'user_id', 'event_id')
            ->withTimestamps();
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? Storage::url($this->avatar) : asset('assets/profile.png');
    }

    // ======================================================================
    // Mutators
    // ======================================================================

    // ======================================================================
    // Custom Functions
    // ======================================================================
    public function updateAvatar($file): bool
    {
        // Delete old image if it exists
        $path = 'public/avatars';
        if ($this->avatar) {
            Storage::disk($path)->delete($this->avatar);
        }

        $path = Storage::putFile($path, $file);

        // Update the image column
        return $this->update(['avatar' => $path]);
    }

    public function isPrivate(): bool
    {
        return $this->is_private === true;
    }

    public function isFriendsWith(User $user): bool
    {
        return $this->friends()->where('friend_id', $user->id)->exists();
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeBySearch($query, ?string $search = null)
    {
        if (! $search) {
            return $query;
        }

        return $query->where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('user_name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%');
    }

    public function scopeByInterests($query, array $interests = [])
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }

    public function scopeByUser($query, int $id)
    {
        return $query->where('id', $id);
    }

    public function scopeByUsers($query, array $ids)
    {
        return $query->whereIn('id', $ids);
    }

    public function scopeByNotUser($query, int $id)
    {
        return $query->where('id', '<>', $id);
    }

    public function scopeByNotUsers($query, array $ids)
    {
        return $query->whereIn('id', '!=', $ids);
    }
}

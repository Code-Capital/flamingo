<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use DateFormattingTrait;
    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'avatar',
        'email_verified_at',
        'is_block',
        'location_id',
        'password',
        'remember_token',
        'gender',
        'age',
        'country',
        'state',
        'bio',
        'about',
        'active_status',
        'dark_mode',
        'messenger_color',
        'is_private',
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
        'deletd_at',
        'email_verified_at',
        'created_at',
        'updated_at',
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
            'active_status' => 'boolean',
        ];
    }

    // ======================================================================
    // Relationships
    // =====================================================================
    // social relationships
    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

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

    public function joinedEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id')
            ->wherePivot('status', StatusEnum::ACCEPTED->value)
            ->withTimestamps();
    }

    // Pages Relationships
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function joinedPages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'page_user', 'user_id', 'page_id')
            ->withPivot('start_date', 'end_date', 'is_invited', 'status')
            ->withTimestamps();
    }

    public function acceptedPages(): BelongsToMany
    {
        return $this->joinedPages()
            ->wherePivot('status', StatusEnum::ACCEPTED->value);
    }

    public function pendingPages(): BelongsToMany
    {
        return $this->joinedPages()
            ->wherePivot('status', StatusEnum::PENDING->value);
    }

    public function rejectedPages(): BelongsToMany
    {
        return $this->joinedPages()
            ->wherePivot('status', StatusEnum::REJECTED->value);
    }

    public function invitedPages(): BelongsToMany
    {
        return $this->joinedPages()
            ->wherePivot('is_invited', true);
    }

    // Location Relationship
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    // ======================================================================
    // Accessors
    // ======================================================================
    public function getFirstNameAttribute($value): string
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value): string
    {
        return ucfirst($value);
    }

    public function getUserNameAttribute($value): string
    {
        return ucfirst($value);
    }

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

    public function setFirstNameAttribute($value): void
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = strtolower($value);
    }

    public function setUserNameAttribute($value): void
    {
        $this->attributes['user_name'] = strtolower($value);
    }

    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower($value);
    }

    // ======================================================================
    // Custom Functions
    // ======================================================================
    public function updateAvatar($file): bool
    {
        $path = 'public/avatars';

        // Delete old image if it exists
        if ($this->avatar) {
            Storage::delete($this->avatar);
        }

        // Store the new file and update the avatar column
        $this->avatar = $file->store($path);

        return $this->save();
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

    public function isEventOwner(Event $event): bool
    {
        return $this->id === $event->user_id;
    }

    public function isBlocked(): bool
    {
        return $this->is_block;
    }

    public function getUsersWithSameInterests($limit = 10)
    {
        // Get the interest IDs of the current user
        $interestIds = $this->interests()->pluck('interest_id');

        // Return users who have the same interests, excluding the current user
        return User::whereIn('id', function ($query) use ($interestIds) {
            $query->select('user_id')
                ->from('interest_user')
                ->whereIn('interest_id', $interestIds);
        })
            ->where('id', '<>', $this->id)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->distinct()
            ->get();
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeBySearch($query, ?string $search = null)
    {

        return $query->when($search, function ($query) use ($search) {
            $query->where('first_name', 'like', '%'.$search.'%')
                ->orWhere('last_name', 'like', '%'.$search.'%')
                ->orWhere('user_name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        });
    }

    public function scopeByInterests($query, array $interests = [])
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }

    public function scopeByLocation($query, $location = null)
    {
        return $query->when($location, function ($query) use ($location) {
            $query->where('location_id', $location);
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

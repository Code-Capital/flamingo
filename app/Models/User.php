<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Billable;
    use DateFormattingTrait;
    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    public const ADMIN_ID = 1;

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
        'country_id',
        'county_id',
        'state_id',
        'bio',
        'about',
        'active_status',
        'dark_mode',
        'messenger_color',
        'is_private',
        'is_subscribed',
        'premium_expires_at'
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

    public function reverseFriends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
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

    public function currentMonthJoinedEvent()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id')
            ->whereMonth('events.created_at', now()->month)
            ->whereYear('events.created_at', now()->year);
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

    public function currentMonthJoinedPages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'page_user', 'user_id', 'page_id')
            ->whereMonth('pages.created_at', now()->month)
            ->whereYear('pages.created_at', now()->year);
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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
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
        if ($this->avatar) {
            if (Storage::exists($this->avatar)) {
                return Storage::url($this->avatar);
            } else {
                return Storage::url('avatars/' . $this->avatar);
            }
        } else {
            return asset('assets/avatar.jpg');
        }
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

    // public function isSubscribed(): bool
    // {
    //     return ($this->subscribed('default') || $this->is_subscribed) ? true : false;
    // }

    public function isSubscribed(): bool
    {
        // Check if the user is subscribed via Stripe or similar service
        $isStripeSubscribed = $this->subscribed('default');

        // Check if the user has manual subscription
        $isManualSubscribed = $this->is_subscribed;

        // Check if the user is within the 3-day premium trial period
        $isTrialActive = $this->premium_expires_at && now()->lt($this->premium_expires_at);

        // Return true if the user is subscribed via Stripe, manual subscription, or is still on trial
        return $isStripeSubscribed || $isManualSubscribed || $isTrialActive;
    }

    public function getCurrentMonthEvents(): int
    {
        return $this->events()
            ->whereMonth('created_at', now())
            ->whereYear('created_at', now())
            ->count();
    }

    public function getCurrentMonthJoinings(): int
    {
        return $this->currentMonthJoinedEvent()->count();
    }

    public function getRemainingEvents(): int
    {
        $count = 0;
        $monthCount = $this->getCurrentMonthEvents();
        $setting = Setting::first();
        if ($this->isSubscribed()) {
            $totalAllowed = $setting->sub_event_create_count ?? 0;
        } else {
            $totalAllowed = $setting->un_sub_event_create_count ?? 0;
        }

        $count = intval($totalAllowed) - intval($monthCount);

        return ($count > 0) ? $count : 0;
    }

    public function getRemainingEventsJoinings(): int
    {
        $count = 0;
        $monthCount = $this->getCurrentMonthJoinings();
        $setting = Setting::first();
        if ($this->isSubscribed()) {
            $totalAllowed = $setting->sub_event_join_count ?? 0;
        } else {
            $totalAllowed = $setting->un_sub_event_join_count ?? 0;
        }

        $count = intval($totalAllowed) - intval($monthCount);

        return ($count > 0) ? $count : 0;
    }

    public function getCurrentMonthPages(): int
    {
        return $this->pages()
            ->whereMonth('created_at', now())
            ->whereYear('created_at', now())
            ->count();
    }

    public function getCurrentMonthPageJoinings(): int
    {
        return $this->currentMonthJoinedPages()->count();
    }

    public function getRemainingPages(): int
    {
        $count = 0;
        $monthCount = $this->getCurrentMonthPages();
        $setting = Setting::first();
        if ($this->isSubscribed()) {
            $totalAllowed = $setting->sub_page_create_count ?? 0;
        } else {
            $totalAllowed = $setting->un_sub_page_create_count ?? 0;
        }

        $count = intval($totalAllowed) - intval($monthCount);

        return ($count > 0) ? $count : 0;
    }

    public function getRemainingPageJoinings(): int
    {
        $count = 0;
        $monthCount = $this->getCurrentMonthPageJoinings();
        $setting = Setting::first();
        if ($this->isSubscribed()) {
            $totalAllowed = $setting->sub_page_join_count ?? 0;
        } else {
            $totalAllowed = $setting->un_sub_page_join_count ?? 0;
        }

        $count = intval($totalAllowed) - intval($monthCount);

        return ($count > 0) ? $count : 0;
    }

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeBySearch(Builder $query, ?string $search = null): Builder
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('user_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    public function scopeByInterests(Builder $query, array $interests = []): Builder
    {
        return $query->when($interests, function ($q) use ($interests) {
            $q->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interest_id', $interests);
            });
        });
    }

    public function scopeByLocation(Builder $query, $location = null): Builder
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
        return $query->where('id', '!=', $id);
    }

    public function scopeByNotUsers($query, array $ids)
    {
        return $query->whereIn('id', '!=', $ids);
    }

    public function scopeByNotFriends($query, int $id)
    {
        return $query->whereDoesntHave('friends', function ($q) use ($id) {
            $q->where('friend_id', $id);
        });
    }

    // Dog Information

    public function scopeByDogBreed(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('dog_breed', $search);
            }
        });
    }
    public function scopeByDogGender(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('dog_gender', $search);
            }
        });
    }


    public function scopeByKennelClub(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('kennel_club', $search);
            }
        });
    }

    public function scopeByDogWorkingClub(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('dog_working_club', $search);
            }
        });
    }

    public function scopeByDogWithersHeight(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('dog_withers_height', $search);
            }
        });
    }

    public function scopeByWeight(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('weight', $search);
            }
        });
    }


    public function scopeBySize(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('size', $search);
            }
        });
    }


    public function scopeByCastrated(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('castrated', $search);
            }
        });
    }


    public function scopeByTarget(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('target', $search);
            }
        });
    }

    public function scopeByFurr(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('furr', $search);
            }
        });
    }

    public function scopeByDrawing(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('drawing', $search);
            }
        });
    }

    public function scopeByHills(Builder $query, ?string $search = null): Builder
    {
        return $query->whereHas('userInfo', function ($q) use ($search) {
            if ($search) {
                $q->where('hills', $search);
            }
        });
    }
}

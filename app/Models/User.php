<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        'avatar_url'
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

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('accepted', 'blocked', 'favorite', 'close_friend', 'family')
            ->withTimestamps();
    }

    public function acceptedFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('accepted', true);
    }

    public function blockedFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('blocked', true);
    }

    public function favoriteFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('favorite', true);
    }

    public function closeFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('close_friend', true);
    }

    public function familyFriends(): BelongsToMany
    {
        return $this->friends()->wherePivot('family', true);
    }

    public function friendRequests(): BelongsToMany
    {
        return $this->friends()->wherePivot('accepted', false);
    }

    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class);
    }

    public function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // ======================================================================
    // Accessors
    // ======================================================================\
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

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeBySearch($query, string $search = null)
    {
        if (!$search) {

        }
        return $query->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('user_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }

    public function scopeByInterests($query, array $interests = [])
    {
        if (empty($interests)) {
            return $query;
        }
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
        return $query->where('id', '!=', $id);
    }

    public function scopeByNotUsers($query, array $ids)
    {
        return $query->whereIn('id', '!=', $ids);
    }

}

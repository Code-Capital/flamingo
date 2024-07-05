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
        'name',
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

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Like::class);
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function friendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'user_id', 'friend_id');
    }

    public function friendRequestsSent(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'friend_id', 'user_id');
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
        return "{$this->name} {$this->last_name}";
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

    // ======================================================================
    // Scopes
    // ======================================================================

}

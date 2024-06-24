<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        Log::info("Avatar path: $path");
        // Update the image column
        $this->update(['avatar' => $path]);
        return true;
    }

    // ======================================================================
    // Scopes
    // ======================================================================

}

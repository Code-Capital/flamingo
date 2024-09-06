<?php

namespace App\Models;

use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ChChannel extends Model
{
    use UUID;

    protected $fillable = [
        'avatar',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ch_channel_user', 'channel_id', 'user_id');
    }
}

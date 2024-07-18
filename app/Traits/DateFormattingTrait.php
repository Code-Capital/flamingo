<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait DateFormattingTrait
{
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->translatedFormat('j M \a\t h:i A');
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait DateFormattingTrait
{
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->translatedFormat('j M \a\t h:i A');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->updated_at)->translatedFormat('j M \a\t h:i A');
    }

    public function getFormattedStartDateAttribute(): string
    {
        return Carbon::parse($this->start_date)->translatedFormat('l, j F Y');
    }

    public function getFormattedEndDateAttribute(): string
    {
        return Carbon::parse($this->end_date)->translatedFormat('l, j F Y');
    }
}

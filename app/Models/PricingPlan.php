<?php

namespace App\Models;

use App\Traits\DateFormattingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription;

class PricingPlan extends Model
{
    use DateFormattingTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'amount',
        'currency',
        'interval',
        'status',
        'stripe_product_id',
        'stripe_price_id',
        'stripe_plan_id',
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
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // ======================================================================
    // Accessors
    // ======================================================================

    // ======================================================================
    // Mutators
    // ======================================================================

    // ======================================================================
    // Custom Functions
    // ======================================================================

    // ======================================================================
    // Scopes
    // ======================================================================
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    public function scopeMonthly($query)
    {
        return $query->where('interval', 'monthly');
    }

    public function scopeYearly($query)
    {
        return $query->where('interval', 'yearly');
    }

    public function scopeLifetime($query)
    {
        return $query->where('interval', 'lifetime');
    }

    public function scopeFree($query)
    {
        return $query->where('amount', 0);
    }

    public function scopePaid($query)
    {
        return $query->where('amount', '>', 0);
    }

    public function scopeAmount($query, $amount)
    {
        return $query->where('amount', $amount);
    }

    public function scopeCurrency($query, $currency)
    {
        return $query->where('currency', $currency);
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }
}

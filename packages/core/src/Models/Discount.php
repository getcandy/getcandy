<?php

namespace GetCandy\Models;

use GetCandy\Base\BaseModel;
use GetCandy\Base\Traits\HasTranslations;
use GetCandy\Database\Factories\DiscountFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends BaseModel
{
    use HasFactory,
        HasTranslations;

    /**
     * Define which attributes should be cast.
     *
     * @var array
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'data' => 'array',
    ];

    /**
     * Return a new factory instance for the model.
     *
     * @return DiscountFactory
     */
    protected static function newFactory(): DiscountFactory
    {
        return DiscountFactory::new();
    }

    /**
     * Return the purchasables relationship.
     *
     * @return HasMany
     */
    public function purchasables()
    {
        return $this->hasMany(DiscountPurchasable::class);
    }

    public function purchasableConditions()
    {
        return $this->hasMany(DiscountPurchasable::class)->whereType('condition');
    }

    public function purchasableRewards()
    {
        return $this->hasMany(DiscountPurchasable::class)->whereType('reward');
    }

    public function type()
    {
        return app($this->type)->with($this);
    }

    /**
     * Return the collections relationship.
     *
     * @return HasMany
     */
    public function collections()
    {
        return $this->hasMany(DiscountCollection::class);
    }

    /**
     * Return the active scope.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereNotNull('starts_at')
            ->whereDate('starts_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhereDate('ends_at', '>', now());
            });
    }
}

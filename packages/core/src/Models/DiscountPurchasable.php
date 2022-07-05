<?php

namespace GetCandy\Models;

use GetCandy\Base\BaseModel;
use GetCandy\Database\Factories\DiscountPurchasableFactory;
use GetCandy\Discounts\Database\Factories\DiscountFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountPurchasable extends BaseModel
{
    use HasFactory;

    /**
     * Define which attributes should be cast.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Return a new factory instance for the model.
     *
     * @return DiscountFactory
     */
    protected static function newFactory(): DiscountPurchasableFactory
    {
        return DiscountPurchasableFactory::new();
    }

    /**
     * Return the discount relationship.
     *
     * @return BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Return the priceable relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function purchasable()
    {
        return $this->morphTo();
    }

    public function scopeCondition(Builder $query)
    {
        $query->whereType('condition');
    }
}

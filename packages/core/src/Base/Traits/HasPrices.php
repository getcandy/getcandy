<?php

namespace GetCandy\Base\Traits;

use GetCandy\Facades\Pricing;
use GetCandy\Models\Currency;
use GetCandy\Models\Price;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

trait HasPrices
{
    /**
     * Get all of the models prices.
     */
    public function prices()
    {
        return $this->morphMany(
            Price::class,
            'priceable'
        );
    }

    /**
     * Return base prices query.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function basePrices()
    {
        return $this->prices()->whereTier(1)->whereNull('customer_group_id');
    }

    /**
     * Return a Price based upon criteria.
     *
     * @param  int  $qty
     * @param  Currency  $currency
     * @param  Authenticatable  $user
     * @param  mixed  $customerGroups
     * @return \GetCandy\DataTypes\Price
     */
    public function getPrice(int $qty = 1, Currency $currency = null, Authenticatable $user = null, $customerGroups = null)
    {
        $pricing = Pricing::qty($qty);

        // Set currency, even if NULL
        $pricing->currency($currency);

        // Set user, even if NULL
        $pricing->user($user);

        // Set customerGroups, even if NULL
        if ($customerGroups instanceof Collection) {
            $pricing->customerGroups($customerGroups);
        } else {
            $pricing->customerGroup($customerGroups);
        }

        return $pricing->for($this);
    }
}

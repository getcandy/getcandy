<?php

namespace GetCandy\Base;

use GetCandy\Models\Currency;
use GetCandy\Models\TaxClass;
use Illuminate\Support\Collection;

interface Purchasable
{
    /**
     * Get the price for the purchasable item.
     *
     * @param int        $quantity
     * @param Collection $customerGroups
     *
     * @return int
     */
    public function getPrice(int $quantity, Currency $currency, Collection $customerGroups): int;

    /**
     * Get the purchasable prices.
     *
     * @return Collection
     */
    public function getPrices(): Collection;

    /**
     * Return the purchasable unit quantity.
     *
     * @return int
     */
    public function getUnitQuantity(): int;

    /**
     * Return the purchasable tax class.
     */
    public function getTaxClass(): TaxClass;

    /**
     * Return the purchasable tax reference.
     *
     * @return string|null
     */
    public function getTaxReference();

    /**
     * Return what type of purchasable this is, i.e. physical,digital,shipping.
     *
     * @return string
     */
    public function getType();

    /**
     * Return the description for the purchasable.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Return the option for this purchasable.
     *
     * @return string|null
     */
    public function getOption();

    /**
     * Return a unique string which identifies the purchasable item.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Returns whether the purchasable item is shippable.
     *
     * @return bool
     */
    public function isShippable();

    /**
     * Return the thumbnail for the purchasable item.
     *
     * @return string
     */
    public function getThumbnail();
}

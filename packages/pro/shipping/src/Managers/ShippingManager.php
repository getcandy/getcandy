<?php

namespace GetCandy\Shipping\Managers;

use GetCandy\Base\Addressable;
use GetCandy\Models\Cart;
use GetCandy\Shipping\Actions\GetShippingMethods;
use GetCandy\Shipping\Actions\GetShippingZones;
use GetCandy\Shipping\Drivers\ShippingMethods\Collection;
use GetCandy\Shipping\Drivers\ShippingMethods\FlatRate;
use GetCandy\Shipping\Drivers\ShippingMethods\FreeShipping;
use GetCandy\Shipping\Drivers\ShippingMethods\ShipBy;
use GetCandy\Shipping\Interfaces\ShippingMethodManagerInterface;
use Illuminate\Support\Manager;

class ShippingManager extends Manager implements ShippingMethodManagerInterface
{
    public function createFreeShippingDriver()
    {
        return $this->buildProvider(FreeShipping::class);
    }

    public function createFlatRateDriver()
    {
        return $this->buildProvider(FlatRate::class);
    }

    public function createShipByDriver()
    {
        return $this->buildProvider(ShipBy::class);
    }

    public function createCollectionDriver()
    {
        return $this->buildProvider(Collection::class);
    }

    public function getSupportedDrivers()
    {
        return collect(array_merge([
            'free-shipping' => $this->createDriver('free-shipping'),
            'flat-rate' => $this->createDriver('flat-rate'),
            'ship-by' => $this->createDriver('ship-by'),
            'collection' => $this->createDriver('collection'),
        ], $this->customCreators));
    }

    /**
     * Find the zone for a given address
     *
     * @param Cart $cart
     *
     * @return Collection
     */
    public function getShippingZones(Cart $cart)
    {
        return app(GetShippingZones::class)->execute($cart);
    }

    public function getShippingMethods(Cart $cart)
    {
        return app(GetShippingMethods::class)->execute($cart);
    }

    /**
     * Build a tax provider instance.
     *
     * @param  string  $provider
     * @return mixed
     */
    public function buildProvider($provider)
    {
        return $this->container->make($provider);
    }

    public function getDefaultDriver()
    {
        return 'free-shipping';
    }
}
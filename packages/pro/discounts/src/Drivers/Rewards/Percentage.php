<?php

namespace GetCandy\Discounts\Drivers\Rewards;

use GetCandy\DataTypes\Price;
use GetCandy\Discounts\Models\DiscountCondition;
use GetCandy\Discounts\Models\DiscountReward;
use GetCandy\Models\Cart;
use GetCandy\Models\CartLine;

class Percentage
{
    protected DiscountReward $reward;

    public function with(DiscountReward $discountReward)
    {
        $this->reward = $discountReward;

        return $this;
    }

    public function apply(CartLine $cartLine): CartLine
    {

        $percentage = $this->reward->data->amount ?? 0;

        $subTotal = $cartLine->subTotal->value;

        $amount = (int) round($subTotal * ($percentage / 100));

        $cartLine->discountTotal = new Price(
            $amount,
            $cartLine->cart->currency,
            1
        );

        return $cartLine;
    }
}

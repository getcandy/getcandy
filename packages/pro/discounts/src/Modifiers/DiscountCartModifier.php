<?php

namespace GetCandy\Discounts\Modifiers;

use Closure;
use GetCandy\Base\CartLineModifier;
use GetCandy\Discounts\Facades\Discounts;
use GetCandy\Discounts\Models\Discount;
use GetCandy\Models\Cart;
use GetCandy\Models\CartLine;

class DiscountCartModifier extends CartLineModifier
{
    public function subtotalled(CartLine $cartLine, Closure $next): CartLine
    {
//         clock()->event('Discounts')->color('purple')->begin();
//
        $discounts = Discount::with([
            'rulesets.rules.purchasables',
            'rewards',
        ])->active()->orderBy('priority')->get();
//
//         $cartMeta = $cartLine->cart->meta ?: (object) [];

        foreach ($discounts as $discount) {
            foreach ($discount->rulesets as $ruleset) {
                if (Discounts::ruleset($ruleset)->check($cartLine->cart)) {
                    dd(1);
                }
            }
        }
//
//         $appliedDiscounts = collect();
//
//         foreach ($discounts as $discount) {
//             // $hasApplied = false;
//
//             foreach ($discount->conditions as $condition) {
//                 if ($condition->driver()->check($cartLine->cart)) {
//                     // $hasApplied = true;
//
//                     $appliedDiscounts->push(
//                         $discount->translateAttribute('name')
//                     );
//                     foreach ($discount->rewards as $reward) {
//                         $cartLine = $reward->driver()->apply($cartLine);
//                     }
//                 }
//                 continue;
//             }
//
//             // if ($hasApplied && $discount->stop) {
//             //     continue;
//             // }
//         }
//
//         if ($appliedDiscounts->count()) {
//             $cartMeta->discounts = $appliedDiscounts->unique()->toArray();
//         } else {
//             $cartMeta->discounts = null;
//         }
//
//         $cartLine->cart->update([
//             'meta' => $cartMeta,
//         ]);
//
//         clock()->event('Discounts')->end();

        return $next($cartLine);
    }
//
//     public function calculated(Cart $cart, Closure $next): Cart
//     {
//         // dd(2);
//
//         return $next($cart);
//     }
}
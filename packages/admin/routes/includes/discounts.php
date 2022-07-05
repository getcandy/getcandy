<?php

use GetCandy\Hub\Http\Livewire\Pages\Discounts\DiscountShow;
use GetCandy\Hub\Http\Livewire\Pages\Discounts\DiscountsIndex;
use GetCandy\Hub\Http\Livewire\Pages\Products\ProductCreate;
use GetCandy\Hub\Http\Livewire\Pages\Products\ProductShow;
use GetCandy\Hub\Http\Livewire\Pages\Products\Variants\VariantShow;
use Illuminate\Support\Facades\Route;

/**
 * Channel routes.
 */
Route::group([
    // 'middleware' => 'can:catalogue:manage-discounts',
], function () {
    Route::get('/', DiscountsIndex::class)->name('hub.discounts.index');
    Route::get('{discount}', DiscountShow::class)->name('hub.discounts.show');
//     Route::get('create', ProductCreate::class)->name('hub.products.create');
//
//     Route::group([
//         'prefix' => '{product}',
//     ], function () {
//         Route::get('/', ProductShow::class)->name('hub.products.show');
//
//         Route::group([
//             'prefix' => 'variants',
//         ], function () {
//             Route::get('{variant}', VariantShow::class)->name('hub.products.variants.show');
//         });
//     });
});

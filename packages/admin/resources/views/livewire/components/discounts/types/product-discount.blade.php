<div class="space-y-4">
    <x-hub::input.group for="min_qty" label="Purchase amount" instructions="When there are X items in the cart, the discount applies">
        <x-hub::input.text type="number" id="min_qty" wire:model="discount.data.min_qty" />
    </x-hub::input.group>

    <x-hub::input.group for="reward_qty" label="No. of free items" instructions="How many of each item are discounted">
        <x-hub::input.text type="number" wire:model="discount.data.reward_qty" />
    </x-hub::input.group>

    <header class="flex items-center justify-between">
        <div>
            <strong>Products</strong>
            <p class="text-sm text-gray-600">Select the products required for the discount to apply</p>
        </div>
        <div>
            @livewire('hub.components.product-search', [
                'existing' => collect(),
                'ref' => 'discount-conditions',
                'showBtn' => true,
                {{-- 'exclude' => [$product->id] --}}
            ])
        </div>
    </header>

    <div class="space-y-1">
        @foreach($this->purchasableConditions as $product)
            <div wire:key="condition_product_{{ $product->id }}" class="rounded border px-3 py-2 flex items-center">
                <div>
                    <img class="w-8 rounded" src="{{ $product->thumbnail->getUrl('small') }}">
                </div>
                <div class="grow ml-4">
                    {{ $product->translateAttribute('name') }}
                </div>
                <div>
                    <button>
                        <x-hub::icon ref="trash" class="w-4 h-4" />
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <header class="flex items-center justify-between">
        <div>
            <strong>Product rewards</strong>
            <p class="text-sm text-gray-600">Select which products will be discounted if they exist in the cart and the above conditions are met.</p>
        </div>
        <div>
            @livewire('hub.components.product-search', [
                'existing' => collect(),
                'ref' => 'discount-rewards',
                'showBtn' => true,
                {{-- 'exclude' => [$product->id] --}}
            ])
        </div>
    </header>

    <div class="space-y-1">
        @foreach($this->purchasableRewards as $product)
            <div wire:key="reward_product_{{ $product->id }}" class="rounded border px-3 py-2 flex items-center">
                <div>
                    <img class="w-8 rounded" src="{{ $product->thumbnail->getUrl('small') }}">
                </div>
                <div class="grow ml-4">
                    {{ $product->translateAttribute('name') }}
                </div>
                <div>
                    <button>
                        <x-hub::icon ref="trash" class="w-4 h-4" />
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <x-hub::alert>
        If one or more items are in the cart, the cheapest item will be discounted.
    </x-hub::alert>
</div>

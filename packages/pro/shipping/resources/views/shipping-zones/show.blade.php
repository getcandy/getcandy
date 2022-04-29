<div class="flex-col px-8 space-y-4 md:px-12">
  <div class="space-y-4">
    <form action="#" wire:submit.prevent="save" class="shadow sm:rounded-md">
      @include('shipping::partials.forms.shipping-zone')
    </form>
    <div class="shadow sm:rounded-md">
      <div class="flex-col px-4 py-5 space-y-4 bg-white rounded-md sm:p-6">
        <header>
          <h3 class="text-lg font-medium leading-6 text-gray-900">
            Shipping Methods
          </h3>
        </header>

        <div class="space-y-4">
          @foreach($this->shippingMethods as $key => $method)
            <div class="flex items-center justify-between pb-4 border-b" wire:key="{{ $key }}">
              <div class="grow">
                <strong>{{ $method['name'] }}</strong>
                <p class="text-sm text-gray-500">{{ $method['description'] }}</p>
              </div>

              <div class="ml-4">
                <x-hub::input.toggle :on="$method['enabled']" wire:click="toggleMethod('{{ $key }}')" />
              </div>

              @if($method['method'] && $method['method']->enabled)
                <div class="ml-4">
                  <x-hub::button wire:click="$set('methodToEdit', '{{ $key }}')">Edit</x-hub::button>
                </div>
              @endif

              <div @if($methodToEdit != $key) class="hidden" @endif>
                <x-hub::slideover title="Free Shipping" wire:model="methodToEdit">
                  @livewire($method['component'], [
                    'shippingMethod' => $method['method'],
                    'shippingZone' => $shippingZone,
                  ], key('shipping_method_'.$key))
                </x-hub::slideover>
              </div>
            </div>
          @endforeach

          {{-- <div class="flex items-center justify-between pb-4 border-b">
            <div class="grow">
              <strong>Flat Rate</strong>
              <p class="text-sm text-gray-500">Charge a fixed shipping cost per order or per item.</p>
            </div>

            <div class="ml-4">
              <x-hub::input.toggle :on="true" />
            </div>

            <div class="ml-4">
              <x-hub::button type="button" wire:click="$set('showFlatRateShipping', true)">Edit</x-hub::button>
            </div>
          </div>

          <div class="flex items-center justify-between pb-4 border-b">
            <div class="grow">
              <strong>Ship by weight/total</strong>
              <p class="text-sm text-gray-500">Calculate shipping cost based on order value or the total weight of items.</p>
            </div>

            <div class="ml-4">
              <x-hub::input.toggle :on="true" />
            </div>

            <div class="ml-4">
              <x-hub::button type="button" wire:click="$set('showShipByTotal', true)">Edit</x-hub::button>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="grow">
              <strong>Collection in store</strong>
              <p class="text-sm text-gray-500">Allow customers to pick up their order in store.</p>
            </div>

            <div class="ml-4">
              <x-hub::input.toggle :on="false" />
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

  {{-- @include('shipping::partials.ship-by-total')
  @include('shipping::partials.free-shipping')
  @include('shipping::partials.flat-rate') --}}
</div>
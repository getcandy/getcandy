
<div class="flex-col space-y-4">
  <div class="flex justify-between">
    @include('adminhub::partials.navigation.taxes')

    <x-hub::button wire:click="$set('taxClassId', 'new')">
      {{ __('adminhub::settings.taxes.tax-classes.create_btn') }}
    </x-hub::button>
  </div>

  <div>
  @if($this->taxClass)
    <x-hub::modal.dialog form="save" wire:model="taxClassId">
        <x-slot name="title">
          {{ __('adminhub::settings.taxes.tax-classes.index.update.title') }}
        </x-slot>

        <x-slot name="content">
          <div class="space-y-4">
            <x-hub::input.group label="Name" for="name">
              <x-hub::input.text wire:model="taxClass.name"  />
            </x-hub::input.group>


            <x-hub::input.group label="Default" for="default">
              <x-hub::input.toggle :on="$taxClass->default" wire:click="toggleDefault"/>
            </x-hub::input.group>
          </div>

        </x-slot>

        <x-slot name="footer">
          <x-hub::button type="button" wire:click.prevent="$set('taxClassId', null)" theme="gray">
            {{ __('adminhub::global.cancel') }}
          </x-hub::button>

          <x-hub::button type="submit">
            {{ __('adminhub::global.save') }}
          </x-hub::button>
        </x-slot>
    </x-hub::modal.dialog>
  @endif
  </div>

  <x-hub::table>
    <x-slot name="head">
      <x-hub::table.heading>Name</x-hub::table.heading>
      <x-hub::table.heading>Default</x-hub::table.heading>
      <x-hub::table.heading></x-hub::table.heading>
    </x-slot>
    <x-slot name="body">
      @foreach($taxClasses as $taxClass)
        <x-hub::table.row>
          <x-hub::table.cell>
            {{ $taxClass->name }}
          </x-hub::table.cell>

          <x-hub::table.cell>
            <x-hub::icon :ref="$taxClass->default ? 'check' : 'x'" :class="$taxClass->default ? 'text-green-500' : 'text-red-500'" style="solid" />
          </x-hub::table.cell>

          <x-hub::table.cell>
            <a href="#" wire:click.prevent="$set('taxClassId', {{ $taxClass->id }})" class="text-indigo-500 hover:underline">
              {{ __('adminhub::settings.taxes.tax-zones.index.table_row_action_text') }}
            </a>
          </x-hub::table.cell>
        </x-hub::table.row>
      @endforeach
    </x-slot>
  </x-hub::table>
  <div>
    {{ $taxClasses->links() }}
  </div>
</div>
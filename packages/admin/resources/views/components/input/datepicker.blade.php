<div x-data="{ value: @entangle($attributes->wire('model')) }"
     x-init="flatpickr($refs.input, {
         enableTime: {{ $enableTime ? 'true' : 'false' }}
     })"
     x-on:change="value = $event.target.value"
     class="relative flex">
    <x-hub::input.text x-ref="input"
                       type="text"
                       x-bind:value="value"
                       class="dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                       {{ $attributes->whereDoesntStartWith('wire:model') }} />

    <div x-show="value"
         class="absolute right-0 mr-3">
        <button x-on:click="value = null"
                type="button"
                class="inline-flex items-center text-sm text-gray-500 transition hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
            <x-hub::icon ref="x-circle"
                         class="w-4 mt-2" />
        </button>
    </div>
</div>

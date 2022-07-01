<div>
    {{-- <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
      <h1 class="text-2xl font-semibold text-gray-900">{{ __('adminhub::global.dashboard') }}</h1>

      <div class="flex items-center space-x-4">
          <x-hub::input.datepicker wire:model="range.from" />
          <span class="text-xs font-medium text-gray-500 uppercase">{{ __('adminhub::global.to') }}</span>
          <x-hub::input.datepicker wire:model="range.to" />
      </div>
  </div> --}}

    <div class="space-y-4 lg:space-y-8">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 sm:gap-8">
            <article
                     class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ __('adminhub::global.new_products') }}
                        </p>

                        <p class="text-2xl font-semibold text-gray-900 dark:text-white mt-0.5">
                            {{ $this->newProductsCount }}
                        </p>
                    </div>

                    <span class="p-3 rounded-full text-emerald-600 bg-emerald-100">
                        <x-hub::icon ref="color-swatch"
                                     style="solid"
                                     class="w-8 h-8" />
                    </span>
                </div>

                <div class="flex gap-1 mt-1 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>

                    <p class="flex gap-2 text-xs">
                        <span class="font-semibold">
                            12.43%
                        </span>

                        <span class="text-gray-700 dark:text-gray-400">
                            From last week
                        </span>
                    </p>
                </div>
            </article>

            <article
                     class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">
                            Total Sales
                        </p>

                        <p class="text-2xl font-semibold text-gray-900 dark:text-white mt-0.5">
                            $12,494.16
                        </p>
                    </div>

                    <span class="p-3 rounded-full text-violet-600 bg-violet-100">
                        <x-hub::icon ref="cash"
                                     style="solid"
                                     class="w-8 h-8" />
                    </span>
                </div>

                <div class="flex gap-1 mt-1 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>

                    <p class="flex gap-2 text-xs">
                        <span class="font-semibold">
                            84.81%
                        </span>

                        <span class="text-gray-700 dark:text-gray-400">
                            From last week
                        </span>
                    </p>
                </div>
            </article>

            <article
                     class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ __('adminhub::catalogue.customer.dashboard.returning_customers') }}
                        </p>

                        <p class="text-2xl font-semibold text-gray-900 dark:text-white mt-0.5">
                            {{ $this->returningCustomersPercent }}%
                        </p>
                    </div>

                    <span class="p-3 rounded-full text-amber-600 bg-amber-100">
                        <x-hub::icon ref="user-circle"
                                     style="solid"
                                     class="w-8 h-8" />
                    </span>
                </div>

                <div class="flex gap-1 mt-1 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>

                    <p class="flex gap-2 text-xs">
                        <span class="font-semibold">
                            67.81%
                        </span>

                        <span class="text-gray-700 dark:text-gray-400">
                            From last week
                        </span>
                    </p>
                </div>
            </article>

            <article
                     class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">
                            {{ __('adminhub::catalogue.customer.dashboard.no_of_orders') }}
                        </p>

                        <p class="text-2xl font-semibold text-gray-900 dark:text-white mt-0.5">
                            {{ $this->orderCount }}
                        </p>
                    </div>

                    <span class="p-3 rounded-full text-rose-600 bg-rose-100">
                        <x-hub::icon ref="gift"
                                     style="solid"
                                     class="w-8 h-8" />
                    </span>
                </div>

                <div class="flex gap-1 mt-1 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>

                    <p class="flex gap-2 text-xs">
                        <span class="font-semibold">
                            12.81%
                        </span>

                        <span class="text-gray-700 dark:text-gray-400">
                            From last week
                        </span>
                    </p>
                </div>
            </article>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('adminhub::catalogue.customer.dashboard.sales_performance') }}
                </h3>

                <div
                     class="p-6 mt-4 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 sm:p-8 dark:border-gray-700">
                    <div class="h-96">
                        @livewire('hub.components.reporting.apex-chart', ['options' => $this->salesPerformance])
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('adminhub::catalogue.customer.dashboard.customer_group_orders') }}
                </h3>

                <div
                     class="p-6 mt-4 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 sm:p-8 dark:border-gray-700">
                    <div class="h-96">
                        @livewire('hub.components.reporting.apex-chart', ['options' => $this->customerGroupOrders])
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('adminhub::catalogue.orders.dashboard.recent_orders') }}
                    </h3>

                    <a href="{{ route('hub.orders.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-gray-900 bg-white border border-gray-100 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <span class="text-sm font-medium">
                            View Orders
                        </span>

                        <x-hub::icon ref="chevron-right"
                                     class="w-3 h-3" />
                    </a>
                </div>

                <div
                     class="p-6 mt-4 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 sm:p-8 dark:border-gray-700">
                    <table class="w-full text-gray-900 table-auto dark:text-white">
                        <thead>
                            <tr>
                                <th class="sr-only">
                                    {{ __('adminhub::global.customer') }}
                                </th>

                                <th class="sr-only">
                                    {{ __('adminhub::global.order_ref') }}
                                </th>

                                <th class="sr-only">
                                    {{ __('adminhub::global.placed_at') }}
                                </th>

                                <th class="sr-only">
                                    {{ __('adminhub::global.total') }}
                                </th>

                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="text-sm">
                            @foreach ($this->recentOrders as $order)
                                <tr class="group odd:bg-gray-50 dark:odd:bg-gray-900/50">
                                    <td class="p-4 group-hover:bg-gray-900 group-hover:text-white rounded-l-md">
                                        {{ $order->billingAddress->full_name }}
                                    </td>

                                    <td class="p-4 group-hover:bg-gray-900 group-hover:text-white">
                                        {{ $order->reference }}
                                    </td>

                                    <td class="p-4 group-hover:bg-gray-900 group-hover:text-white">
                                        {{ optional($order->placed_at)->format('jS F Y h:ma') }}
                                    </td>

                                    <td class="p-4 group-hover:bg-gray-900 group-hover:text-white">
                                        {{ $order->total->formatted }}
                                    </td>

                                    <td class="grid p-4 group-hover:bg-gray-900 group-hover:text-white rounded-r-md">
                                        <a href="{{ route('hub.orders.show', $order->id) }}"
                                           class="inline-block p-1 rounded-md hover:bg-gray-800 place-self-center">
                                            <x-hub::icon ref="chevron-right"
                                                         class="w-4 h-4" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('adminhub::catalogue.customer.dashboard.top_selling_products') }}
                </h3>

                <div
                     class="p-6 mt-4 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-800 sm:p-8 dark:border-gray-700">
                    <div class="flow-root">
                        <ul class="-my-4 divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($this->topSellingProducts as $product)
                                <li class="flex items-center gap-4 py-4">
                                    <a href="{{ route('hub.products.show', $product->purchasable->product->id) }}"
                                       class="grid w-16 h-16 border border-gray-100 rounded-md dark:border-gray-700 shrink-0">
                                        @if ($thumbnail = $product->purchasable->getThumbnail())
                                            <img src="{{ $thumbnail }}"
                                                 class="object-contain w-12 h-12 place-self-center" />
                                        @else
                                            <span class="place-self-center">
                                                <x-hub::icon ref="photograph"
                                                             class="w-12 h-12 text-gray-300" />
                                            </span>
                                        @endif
                                    </a>

                                    <div class="flex-1">
                                        <a
                                           href="{{ route('hub.products.show', $product->purchasable->product->id) }}">
                                            <p>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $product->purchasable->getDescription() }}
                                                </span>

                                                <span class="text-xs text-gray-500">
                                                    ({{ $product->purchasable->getIdentifier() }})
                                                </span>
                                            </p>

                                            <p class="mt-1 text-xs text-gray-700 dark:text-gray-300">
                                                {{ $product->count }} Orders
                                            </p>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="en"
      class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Hub' }} | {{ config('app.name') }}</title>

    <link rel="icon"
          type="image/png"
          href="https://cdn.getcandy.io/hub/favicon.svg">
    <link rel="stylesheet"
          href="https://unpkg.com/trix@1.2.3/dist/trix.css" />
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css"
          rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
          rel="stylesheet">
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;900&display=swap"
          rel="stylesheet">
    <link href="{{ asset('vendor/getcandy/admin-hub/app.css?v=1') }}"
          rel="stylesheet">

    <style>
        .filepond--credits {
            display: none !important;
        }
    </style>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script defer
            src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.js"
            integrity="sha512-Fc8SDJVBwajCGX0A9z8lBeRPaCjR25Ek577z9PtQLB7CLBz7Mw1XhjbcD2yDWrGszL/uezKGidtGCng6Fhz3+A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

    @livewireStyles
</head>

<body class="h-full overflow-hidden antialiased"
      x-data="{ showExpandedMenu: false, showInnerMenu: true, showMobileMenu: false }">
    {!! \GetCandy\Hub\GetCandyHub::paymentIcons() !!}

    <div class="flex h-full">
        <div class="relative z-40 lg:hidden"
             role="dialog"
             aria-modal="true">
            <div class="fixed inset-0 bg-gray-600/75"
                 x-show="showMobileMenu"></div>

            <div class="fixed inset-0 z-40 flex"
                 x-show="showMobileMenu"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full">
                <div class="w-full max-w-xs p-4 bg-white focus:outline-none"
                     x-on:click.away="showMobileMenu = false">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('hub.index') }}"
                           class="block">
                            <img class="w-auto h-8"
                                 src="https://markmead.dev/gc-logo.svg"
                                 alt="GetCandy Logo">
                        </a>

                        <button type="button"
                                x-on:click="showMobileMenu = false">
                            <svg class="w-5 h-5"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor"
                                 aria-hidden="true">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-8">
                        <x-hub::menu handle="sidebar"
                                     current="{{ request()->route()->getName() }}">
                            <ul class="space-y-2">
                                @foreach ($component->items as $item)
                                    <li x-data="{ showAccordionMenu: false }">
                                        <a href="{{ route($item->route) }}"
                                           @class([
                                               'flex items-center gap-2 p-2 rounded text-gray-500',
                                               'bg-blue-50 text-blue-700' => request()->routeIs($item->route),
                                           ])>
                                            {!! $item->renderIcon('w-5 h-5') !!}

                                            <span class="text-sm font-medium">
                                                {{ $item->name }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </x-hub::menu>

                        <div class="pt-4 mt-4 border-t border-gray-100">
                            @if (Auth::user()->can('settings'))
                                <div x-data="{ showSettingsMenu: false }">
                                    <a href="{{ route('hub.settings') }}"
                                       @class([
                                           'p-2 rounded text-gray-500 flex items-center justify-between',
                                           'bg-blue-50 text-blue-700' => Str::contains(request()->url(), 'settings'),
                                       ])>
                                        <span class="flex items-center gap-2">
                                            {!! GetCandy\Hub\GetCandyHub::icon('cog', 'w-5 h-5') !!}

                                            <span class="text-sm font-medium">
                                                {{ __('adminhub::global.settings') }}
                                            </span>
                                        </span>

                                        <button x-on:click.prevent="showSettingsMenu = !showSettingsMenu"
                                                class="p-0.5 text-gray-600 bg-white rounded hover:text-gray-700">
                                            <span x-show="showSettingsMenu">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </span>

                                            <span x-show="!showSettingsMenu">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </a>

                                    <div x-show="showSettingsMenu"
                                         class="mt-2 ml-4">
                                        <x-hub::menu handle="settings"
                                                     current="{{ request()->route()->getName() }}">
                                            <ul class="space-y-0.5">
                                                @foreach ($component->items as $item)
                                                    <li>
                                                        <a href="{{ route($item->route) }}"
                                                           @class([
                                                               'p-2 rounded block text-gray-500 text-xs font-medium',
                                                               'bg-blue-50 text-blue-700' => $item->isActive(
                                                                   $component->attributes->get('current')
                                                               ),
                                                           ])>
                                                            {{ $item->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </x-hub::menu>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="relative flex flex-col bg-white border-r border-gray-100"
                 :class="{ 'w-48': showExpandedMenu, 'w-20 items-center': !showExpandedMenu }">
                <a href="{{ route('hub.index') }}"
                   class="flex items-center h-16 px-4">
                    <img src="https://markmead.dev/gc-logo.svg"
                         alt="GetCandy Logo"
                         class="w-auto h-10"
                         x-show="showExpandedMenu" />

                    <img src="https://markmead.dev/gc-favicon.svg"
                         alt="GetCandy Logo"
                         class="w-8 h-8"
                         x-show="!showExpandedMenu">
                </a>

                <div class="px-4 pt-4 border-t border-gray-100">
                    @livewire('sidebar')
                </div>

                <button x-on:click="showExpandedMenu = !showExpandedMenu"
                        class="absolute z-50 p-1 bg-white border border-gray-100 rounded -right-[13px] bottom-8">
                    <span :class="{ '-rotate-180': showExpandedMenu }"
                          class="block">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"
                             fill="currentColor"
                             class="w-4 h-4">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <div class="lg:hidden">
                <div
                     class="flex items-center justify-between h-16 px-4 bg-white border-b border-gray-100 sm:px-6 lg:px-8">
                    <a href="{{ route('hub.index') }}"
                       class="block">
                        <img class="w-8 h-8"
                             src="https://markmead.dev/gc-favicon.svg"
                             alt="GetCandy Logo">
                    </a>

                    <div class="flex items-center gap-4">
                        <button type="button"
                                x-on:click="showMobileMenu = true">
                            <svg class="w-6 h-6"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor"
                                 aria-hidden="true">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <span class="w-px h-8 bg-gray-100"
                              aria-hidden="true"></span>

                        <div x-data="{ showUserMenu: false }"
                             x-on:click="showUserMenu = !showUserMenu"
                             x-on:click.away="showUserMenu = false"
                             class="relative">
                            <div x-show="showUserMenu"
                                 x-transition
                                 class="absolute z-50 p-2 -mt-2 bg-white border border-gray-100 rounded-lg top-full right-4 w-36">
                                <ul class="flex flex-col">
                                    <li>
                                        <a href="{{ route('hub.account') }}"
                                           class="block p-2 text-sm font-medium text-gray-500 rounded hover:bg-gray-50">
                                            {{ __('adminhub::account.view-profile') }}
                                        </a>
                                    </li>

                                    <li>
                                        <form method="POST"
                                              action="{{ route('hub.logout') }}">
                                            @csrf
                                            <button type="submit"
                                                    class="flex items-center w-full gap-2 p-2 text-gray-500 rounded hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor"
                                                     stroke-width="2">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>

                                                <span class="text-sm font-medium">Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex items-center h-16 gap-2">
                                <div class="shrink-0">
                                    @livewire('hub.components.avatar')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="flex flex-1 overflow-hidden">
                <section class="flex-1 h-full min-w-0 overflow-y-auto lg:order-last">
                    @include('adminhub::partials.header')

                    <div class="px-4 py-8 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
                        @yield('main', $slot)
                    </div>
                </section>

                @if ($menu ?? false)
                    @include('adminhub::partials.inner-menu')
                @endif
            </main>
        </div>
    </div>

    <x-hub::notification />

    @livewire('hub-license')

    @livewireScripts

    <script src="{{ asset('vendor/getcandy/admin-hub/app.js') }}"></script>
</body>

</html>

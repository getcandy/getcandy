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
                 x-show="showMobileMenu">
                <div class="relative flex flex-col flex-1 w-full max-w-xs p-4 bg-white focus:outline-none"
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
                                               'flex justify-between items-center p-2 rounded text-gray-500',
                                               'bg-blue-50 text-blue-700' => request()->routeIs($item->route),
                                           ])>
                                            <span class="flex items-center flex-1 gap-2">
                                                {!! $item->renderIcon('w-5 h-5') !!}

                                                <span class="text-sm font-medium">
                                                    {{ $item->name }}
                                                </span>
                                            </span>

                                            <button x-on:click.prevent="showAccordionMenu = !showAccordionMenu"
                                                    class="p-1 text-gray-600 bg-white rounded hover:text-gray-700">
                                                <span x-show="showAccordionMenu">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-4 h-4"
                                                         viewBox="0 0 20 20"
                                                         fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                </span>

                                                <span x-show="!showAccordionMenu">
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

                                        <div x-show="showAccordionMenu"
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
                                    </li>
                                @endforeach
                            </ul>
                        </x-hub::menu>

                        <div class="pt-4 mt-4 border-t border-gray-100">
                            @if (Auth::user()->can('settings'))
                                <a href="{{ route('hub.settings') }}"
                                   @class([
                                       'relative flex items-center gap-2 p-2 rounded text-gray-500',
                                       'bg-blue-50 text-blue-700' => $item->isActive(
                                           $component->attributes->get('current')
                                       ),
                                   ])>
                                    {!! GetCandy\Hub\GetCandyHub::icon('cog', 'w-5 h-5') !!}

                                    <span class="text-sm font-medium">
                                        {{ __('adminhub::global.settings') }}
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>


                    {{-- <div class="flex flex-shrink-0 p-4 border-t border-gray-200">
                        <a href="#"
                           class="flex-shrink-0 block group">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block w-10 h-10 rounded-full"
                                         src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                         alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">Emily
                                        Selman</p>
                                    <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">Account
                                        Settings</p>
                                </div>
                            </div>
                        </a>
                    </div> --}}
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
                             alt="Workflow">
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

                    <div class="px-4 py-8 sm:px-6 lg:px-8">
                        @yield('main', $slot)
                    </div>
                </section>

                @include('adminhub::partials.inner-menu')
            </main>
        </div>
    </div>


    {{-- <div class="flex h-screen overflow-hidden bg-gray-100" x-data="{ showMenu: false }">
      <div class="fixed inset-0 z-40 flex md:hidden" role="dialog" aria-modal="true" x-cloak x-show="showMenu" x-transition>
        <div
          class="fixed inset-0 bg-gray-600 bg-opacity-75"
          x-transition:enter="transition-opacity ease-linear duration-300"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:enter="transition-opacity ease-linear duration-300"
          x-transition:enter-start="opacity-100"
          x-transition:enter-end="opacity-0"
          x-show="showMenu"
          aria-hidden="true"
        ></div>

        <div
          class="relative flex flex-col flex-1 w-full max-w-xs pt-5 pb-4 bg-white"
          x-transition:enter="transition ease-in-out duration-300"
          x-transition:enter-start="-translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition ease-in-out duration-300"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="-translate-x-full"
          x-show="showMenu"
        >
          <div
            class="absolute top-0 right-0 pt-2 -mr-12"
            x-transition:enter="ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-show="showMenu"
          >
            <button @click="showMenu = false" class="flex items-center justify-center w-10 h-10 ml-1 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
              <span class="sr-only">{{ __('adminhub::menu.close-sidebar') }}</span>
              <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="flex items-center flex-shrink-0 px-4">
            <img class="w-auto h-8" src="https://getcandy.io/hub/getcandy_logo.svg" alt="GetCandy">
          </div>
          <div class="flex-1 h-0 mt-5 overflow-y-auto">
            <nav class="px-2 space-y-1">
              @livewire('sidebar')
            </nav>
          </div>
          <div class="flex flex-shrink-0 p-4 bg-white border-t border-gray-200">
            <a href="{{ route('hub.account') }}" class="flex-shrink-0 block group">
              <div class="flex items-center">
                <div>
                    @livewire('hub.components.avatar')
                </div>
                <div class="ml-3">
                  @livewire('hub.components.current-staff-name', [
                    'class' => 'text-sm font-medium text-gray-700 group-hover:text-gray-900 truncate w-32'
                  ])
                  <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                    {{ __('adminhub::account.view-profile') }}
                  </p>
                </div>
                <div class="pl-2">
                  <form method="POST" action="{{ route('hub.logout') }}">
                    @csrf
                    <button>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 11V13L17 13V16L22 12L17 8V11L8 11Z" fill="#9A9AA9"/>
                        <path d="M4 21H13C14.103 21 15 20.103 15 19V15H13V19H4L4 5H13V9H15V5C15 3.897 14.103 3 13 3H4C2.897 3 2 3.897 2 5L2 19C2 20.103 2.897 21 4 21Z" fill="#9A9AA9"/>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="flex-shrink-0 w-14" aria-hidden="true">
        </div>
      </div>

      <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-50">
          <div class="flex flex-col pt-5 pb-4 overflow-y-auto bg-white grow">
            <div class="flex items-center flex-shrink-0 px-4 mx-4 my-2">
              <img class="w-auto" src="https://getcandy.io/hub/getcandy_logo.svg" alt="GetCandy">
            </div>
            <div class="flex flex-col mt-5 grow">
              <nav class="flex-1 px-2 space-y-1 bg-white">

                @livewire('sidebar')

              </nav>
            </div>
          </div>
          <div class="flex flex-shrink-0 p-4 bg-white border-t border-gray-200">
            <a href="{{ route('hub.account') }}" class="flex-shrink-0 block group">
              <div class="flex items-center">
                <div>
                  @livewire('hub.components.avatar')
                </div>
                <div class="ml-3">
                  @livewire('hub.components.current-staff-name', [
                    'class' => 'text-sm font-medium text-gray-700 group-hover:text-gray-900 truncate w-32'
                  ])
                  <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                    {{ __('adminhub::account.view-profile') }}
                  </p>
                </div>
                <div class="pl-2">
                  <form method="POST" action="{{ route('hub.logout') }}">
                    @csrf
                    <button>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 11V13L17 13V16L22 12L17 8V11L8 11Z" fill="#9A9AA9"/>
                        <path d="M4 21H13C14.103 21 15 20.103 15 19V15H13V19H4L4 5H13V9H15V5C15 3.897 14.103 3 13 3H4C2.897 3 2 3.897 2 5L2 19C2 20.103 2.897 21 4 21Z" fill="#9A9AA9"/>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="flex flex-col flex-1 w-0 overflow-hidden">
        <div class="relative z-10 flex flex-shrink-0 h-16 bg-white shadow md:hidden">
          <button @click="showMenu = true" class="px-4 text-gray-500 border-r border-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
            <span class="sr-only">{{ __('adminhub::menu.open-sidebar') }}</span>
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
          </button>
          <div class="flex justify-between flex-1 px-4">
          </div>
        </div>
        <main class="relative flex-1 overflow-y-auto focus:outline-none">
          <div class="py-8">
            @yield('main', $slot)
          </div>
        </main>
      </div>
    </div> --}}

    <x-hub::notification />

    @livewire('hub-license')

    @livewireScripts

    <script src="{{ asset('vendor/getcandy/admin-hub/app.js') }}"></script>
</body>

</html>

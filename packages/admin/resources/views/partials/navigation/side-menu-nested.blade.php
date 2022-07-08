<x-hub::layout.side-menu>
    <x-hub::menu handle="{{ $menu }}"
                 current="{{ request()->route()->getName() }}">

        <div class="space-y-4">
          @if($component->items->count())
            <ul class="space-y-2">
                @foreach ($component->items as $item)
                    <li>
                        <a href="{{ route($item->route) }}"
                           @class([
                               'flex items-center gap-2 p-2 rounded text-gray-500',
                               'bg-blue-50 text-blue-700 hover:text-blue-600' => $item->isActive(
                                   $component->attributes->get('current')
                               ),
                               'hover:bg-blue-50 hover:text-blue-700' => !$item->isActive(
                                   $component->attributes->get('current')
                               ),
                           ])>
                            {!! $item->renderIcon('shrink-0 w-5 h-5') !!}

                            <span class="text-sm font-medium">
                                {{ $item->name }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
          @endif
          @foreach($component->sections as $section)
            <div>
              <header class="text-sm font-bold text-gray-600">
                {{ $section->name }}
              </header>
              <ul class="space-y-2 mt-2">
                  @foreach ($section->getItems() as $item)
                      <li>
                          <a href="{{ route($item->route) }}"
                             @class([
                                 'flex items-center gap-2 p-2 rounded text-gray-500',
                                 'bg-blue-50 text-blue-700 hover:text-blue-600' => $item->isActive(
                                     $component->attributes->get('current')
                                 ),
                                 'hover:bg-blue-50 hover:text-blue-700' => !$item->isActive(
                                     $component->attributes->get('current')
                                 ),
                             ])>
                              {!! $item->renderIcon('shrink-0 w-5 h-5') !!}

                              <span class="text-sm font-medium">
                                  {{ $item->name }}
                              </span>
                          </a>
                      </li>
                  @endforeach
              </ul>
            </div>
          @endforeach
        </div>
    </x-hub::menu>
</x-hub::layout.side-menu>

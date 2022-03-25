<li class="relative pl-8">

  <div class="absolute top-[2px] -left-[calc(0.5rem_-_1px)]">
    @if($activity->causer)
      <x-hub::gravatar :email="$activity->causer->email" class="w-5 h-5 rounded-full" />
    @elseif($activity->event == 'created')
      <span
        class="absolute w-4 h-4 @if($activity->description == 'created') bg-blue-500 ring-blue-100 @else ring-gray-200 @endif bg-gray-300 rounded-full ring-4"
      >
      </span>
    @endif
  </div>

  <div class="flex justify-between">
    <div>
      <div class="text-xs font-medium text-gray-500">
        @if(!$activity->causer)
          System (Guest)
        @else
          {{ $activity->causer->fullName ?: $activity->causer->name }}
        @endif
      </div>
      <p class="mt-2 text-sm font-medium text-gray-700">
        @if($activity->event == 'status-update')
          Order status changed
          <strong><x-hub::orders.status :status="$activity->getExtraProperty('previous')" /></strong>
          to
          <strong><x-hub::orders.status :status="$activity->getExtraProperty('new')" /></strong>
        @elseif($activity->event == 'created')
          Order Created
        @elseif($activity->event == 'comment')
          {!! nl2br($activity->getExtraProperty('content')) !!}
        @elseif($activity->event == 'charge')
          Payment of {{ price($activity->getExtraProperty('amount'), $this->order->currency)->formatted }} on card ending {{ $activity->getExtraProperty('last_four') }}
        @elseif($activity->event == 'refund')
          Refund of {{ price($activity->getExtraProperty('amount'), $this->order->currency)->formatted }} on card ending {{ $activity->getExtraProperty('last_four') }}
          @if($notes = $activity->getExtraProperty('notes'))
            <p>{{ nl2br($notes) }}</p>
          @endif
        @endif
      </p>
    </div>

    <time class="flex-shrink-0 ml-4 text-xs mt-0.5 text-gray-500 font-medium">
      {{ $activity->created_at->format('h:ia')}}
    </time>
  </div>
</li>
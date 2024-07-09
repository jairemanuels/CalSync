<ol class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8"
    style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
    @foreach ($events as $event)
        @php
            $grid = $event->calculateGridPosition($event->event_time_start, $event->event_time_end);

        @endphp
        <li class="relative mt-px flex sm:col-start-{{ $grid['day'] }}" style="grid-row: {{ $grid['start'] }} / span {{ $grid['span'] }}">
            <a href="#"
                class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100">
                <p class="order-1 font-semibold text-blue-700">{{ $event->name }}</p>
                <p class="text-blue-500 group-hover:text-blue-700"><time datetime="{{ $event->event_time_start }}">{{ \Carbon\Carbon::parse($event->event_time_start)->format('g:i A') }}</time></p>
            </a>
        </li>
        @endforeach
</ol>


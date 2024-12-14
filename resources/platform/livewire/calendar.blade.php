<div>
    <div class="card card-calendar">
        <div class="card-body p-3">
            <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
        </div>
    </div>

    @php
    $events = Route::current()->uri() === '/' ? auth()->user()->events : $teamEvents;
    @endphp

    <link href="/assets/css/plugins/fullcalendar.min.css" rel="stylesheet">
    <script src="/assets/js/plugins/fullcalendar.min.js"></script>
    <script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            initialView: "timeGridWeek",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'dayGridMonth timeGridWeek timeGridDay listWeek today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            selectable: true,
            editable: false,
            firstDay: 1,
            initialDate: '{{ now()->format("Y-m-d") }}',

            @if (Route::current()->uri === 'teams/{uuid}/calendar')

            events: [
                    @foreach ($teamEvents as $event)

                        {
                            title: '{{ $event->event->name }}',
                            start: '{{ \Carbon\Carbon::parse($event->event->event_time_start)->format('Y-m-d H:i:s') }}',
                            end: '{{ \Carbon\Carbon::parse($event->event->event_time_end)->format('Y-m-d H:i:s') }}',
                            color: '{{ $event->color }}',
                            textColor: '#ffffff',
                        },
                    @endforeach

                ],

            @elseif (Route::current()->uri === '/')

            events: [
                    @foreach (auth()->user()->events as $event)

                        {
                            title: '{{ $event->name }}',
                            start: '{{ \Carbon\Carbon::parse($event->event_time_start)->format('Y-m-d H:i:s') }}',
                            end: '{{ \Carbon\Carbon::parse($event->event_time_end)->format('Y-m-d H:i:s') }}',
                            textColor: '#000000',
                        },
                    @endforeach

                ],
            @endif


            color: '#333a5b',


            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

        calendar.render();
    </script>
</div>

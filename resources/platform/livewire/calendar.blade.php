<div>
    <div class="card card-calendar">
        <div class="card-body p-3">
            <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
        </div>
    </div>

    <script src="/assets/js/plugins/fullcalendar.min.js"></script>

    <script>
        function getCalenderEvents() {
            return [
                    @foreach (auth()->user()->events as $event)

                {
                    title: '{{ $event->description }}',
                    start: '{{ $event->starts_at->format('Y-m-d H:i:s') }}',
                    end: '{{ $event->ends_at->format('Y-m-d H:i:s') }}',
                    className: 'bg-gradient-info',
                    extendedProps: {
                        event_id: '{{ $event->id }}'
                    }
                },
                @endforeach
            ];
        }
    </script>

    <script>
        // Function to initialize and render the FullCalendar
        function renderCalendar() {
            var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                timeZone: '{{ config('app.timezone') }}', // Use the user's local time zone
                initialView: "timeGridWeek",
                headerToolbar: {
                    start: 'title', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: 'dayGridMonth timeGridWeek timeGridDay listWeek today prev,next' // will normally be on the right. if RTL, will be on the left
                },
                selectable: true,
                editable: true,
                firstDay: 1,
                initialDate: '{{ now()->format('Y-m-d') }}',
                events: getCalenderEvents(),
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

            // Render the calendar
            calendar.render();

            // When someone drags and drops event we need to save it in our model with an event listener
            calendar.on('eventDrop', function(info) {
                @this.call('saveEvent', info.event.extendedProps.event_id, info.event.start.toISOString(), info.event.end ? info.event.end.toISOString() : null);
            });

            calendar.on('eventResize', function(info) {
                var start = info.event.start.toISOString();
                var end = info.event.end ? info.event.end.toISOString() : null;
                @this.call('saveEvent', info.event.extendedProps.event_id, start, end);
            });
        }


        renderCalendar(); // Initialize the calendar when the page loads
    </script>
</div>

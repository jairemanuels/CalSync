<div>
    <div class="card card-calendar">
        <div class="card-body p-3">
            <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
        </div>
    </div>

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
            editable: true,
            firstDay: 1,
            initialDate: '{{ now()->format('Y-m-d') }}',
            events: [
                @foreach (auth()->user()->events as $event)

                    {
                        title: '{{ $event->description }}',
                        start: '{{ $event->starts_at->format('Y-m-d H:i:s') }}',
                        end: '{{ $event->ends_at->format('Y-m-d H:i:s') }}',
                        className: 'bg-gradient-info'
                    },
                @endforeach

            ],
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

        //when someone drags and drops event we need to save it in our model with an evetnlistener
        calendar.on('eventDrop', function(info) {
            var userId = info.event.extendedProps.customerId; // Adjust this line to get the user_id from the event
            var start = info.event.start.toISOString();
            var end = info.event.end ? info.event.end.toISOString() : null;
            @this.call('saveEvent', {
                customer_id: customer_id,
                start_time: start,
                end_time: end
            });
        });

        calendar.on('eventResize', function(info) {
            var id = info.event.id;
            var start = info.event.start.toISOString();
            var end = info.event.end ? info.event.end.toISOString() : null;
            @this.call('saveEvent', {
                customer_id: customer_id,
                start_time: start,
                end_time: end
            });
        });
    </script>

</div>

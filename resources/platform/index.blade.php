@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-calendar">
            <div class="card-body p-3">
                <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/plugins/fullcalendar.min.js"></script>
<script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
        initialView: "dayGridMonth",
        headerToolbar: {
            start: 'title', // will normally be on the left. if RTL, will be on the right
            center: '',
            end: 'dayGridMonth timeGridWeek timeGridDay listWeek today prev,next' // will normally be on the right. if RTL, will be on the left
        },
        selectable: true,
        editable: true,
        initialDate: '2020-12-01',
        events: [{
            title: 'Call with Dave',
            start: '2020-11-18',
            end: '2020-11-18',
            className: 'bg-gradient-danger'
        },

            {
                title: 'Lunch meeting',
                start: '2020-11-21',
                end: '2020-11-22',
                className: 'bg-gradient-warning'
            },

            {
                title: 'All day conference',
                start: '2020-11-29',
                end: '2020-11-29',
                className: 'bg-gradient-success'
            },

            {
                title: 'Meeting with Mary',
                start: '2020-12-01',
                end: '2020-12-01',
                className: 'bg-gradient-info'
            },

            {
                title: 'Winter Hackaton',
                start: '2020-12-03',
                end: '2020-12-03',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Digital event',
                start: '2020-12-07',
                end: '2020-12-09',
                className: 'bg-gradient-warning'
            },

            {
                title: 'Marketing event',
                start: '2020-12-10',
                end: '2020-12-10',
                className: 'bg-gradient-primary'
            },

            {
                title: 'Dinner with Family',
                start: '2020-12-19',
                end: '2020-12-19',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Black Friday',
                start: '2020-12-23',
                end: '2020-12-23',
                className: 'bg-gradient-info'
            },

            {
                title: 'Cyber Week',
                start: '2020-12-02',
                end: '2020-12-02',
                className: 'bg-gradient-warning'
            },

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
</script>
@endsection

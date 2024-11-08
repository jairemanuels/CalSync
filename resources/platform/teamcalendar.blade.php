@extends('platform::layouts.app', [
    'title' => 'Team Calendar',
    'activePage' => 'teamcalendar',
])

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('platform.add-event-modal')
            @livewire('platform.calendar', ['events' => $events])
            {{-- @include('platform::livewire.projects.teams-calendar') --}}
        </div>
    </div>
@endsection

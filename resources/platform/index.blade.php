@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('platform.add-event-modal')
            @livewire('platform.calendar', ['events' => $events], ['teams' => $teams])
        </div>
    </div>
@endsection

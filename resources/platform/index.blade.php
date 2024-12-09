@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])


@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('platform.calendar', ['teams' => $teams, 'teamEvents' => $teamEvents])
        </div>
    </div>
@endsection

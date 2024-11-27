@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])

@section('content')
    @livewire('platform.requests.request-table')
@endsection

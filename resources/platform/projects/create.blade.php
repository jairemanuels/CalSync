@extends('platform::projects.app', [

])

@section('content')
    <div class="container">
    <div class="row">
        @livewire('platform.projects.setup-wizard')
    </div>
</div>
@endsection

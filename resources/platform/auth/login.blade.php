@extends('platform::auth.app', [

])

@section('content')
    <div class="container">
        <div class="row">
            @livewire('platform.auth.login-form')
        </div>
    </div>
@endsection

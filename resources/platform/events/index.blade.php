@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])

@section('content')
    <div class="container">
            @livewire('platform.model-table', [
                'title' => 'Appointments',
                'model' => \App\Models\Event::class,
                'changableColumns' => true,
                'columns' => [
                    'id' => ['label' => 'ID', 'sortable' => true],
                    'description' => ['label' => 'Description', 'sortable' => true],
                    'starts_at' => ['label' => 'Starts at', 'sortable' => true],
                    'ends_at' => ['label' => 'Ends at', 'sortable' => true],
                    'all_day' => ['label' => 'All Day', 'sortable' => true],
                    'color' => ['label' => 'Color', 'sortable' => true],
                ],
            ])
    </div>
@endsection

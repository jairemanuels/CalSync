@extends('platform::layouts.app', [
    'title' => 'Platform',
    'activePage' => 'platform',
])

@section('content')
    <div class="container">
            @livewire('platform.model-table', [
                'title' => 'Customers',
                'model' => \App\Models\Customer::class,
                'changableColumns' => true,
                'columns' => [
                    'id' => ['label' => 'ID', 'sortable' => true],
                    'name' => ['label' => 'Name', 'sortable' => true],
                    'email' => ['label' => 'Email', 'sortable' => true],
                    'phone' => ['label' => 'Phone', 'sortable' => true],
                    'created_at' => ['label' => 'Created At', 'sortable' => true],
                ],
            ])
    </div>
@endsection

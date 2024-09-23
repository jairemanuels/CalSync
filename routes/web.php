<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Platform\ProjectsController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
});

Route::middleware(['web', 'auth', 'tenant'])->group(function () {
    Route::get('/', function () {
        return view('platform::index');
    });
});

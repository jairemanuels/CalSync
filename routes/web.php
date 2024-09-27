<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Platform\ProjectsController;
use App\Http\Controllers\Platform\PlatformController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
});

Route::middleware(['web', 'auth', 'tenant'])->group(function () {
    Route::get('/', [PlatformController::class, 'index'])->name('platform.index');

    Route::prefix('/customers')->group(function () {
        Route::get('/', [PlatformController::class, 'customers'])->name('platform.customers.index');
    });

    Route::prefix('/events')->group(function () {
        Route::get('/', [PlatformController::class, 'events'])->name('platform.events.index');
    });
});

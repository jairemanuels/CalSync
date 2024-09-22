<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Platform\SetupController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/setup/create', [SetupController::class, 'create'])->name('setup.create');
});

Route::get('/', function () {
    return view('platform::index');
});
